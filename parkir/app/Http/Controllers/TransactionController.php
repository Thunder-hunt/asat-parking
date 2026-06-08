<?php

namespace App\Http\Controllers;

use App\Models\ParkirLocation;
use App\Models\ParkirTransaction;
use App\Models\ParkirVehicleType;
use App\Http\Requests\EnterVehicleRequest;
use App\Http\Requests\ExitVehicleRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display the transaction page with active parking list.
     */
    public function index()
    {
        $locations    = ParkirLocation::all();
        $vehicleTypes = ParkirVehicleType::all();

        // Vehicles currently still parked (masuk only, no keluar yet)
        $activeTransactions = ParkirTransaction::with(['location', 'vehicleType'])
            ->whereNull('keluar')
            ->orderByDesc('masuk')
            ->get();

        // All transactions for the history modal
        $allTransactions = ParkirTransaction::with(['location', 'vehicleType'])
            ->orderByDesc('masuk')
            ->get();

        return view('pages.transaction', compact('locations', 'vehicleTypes', 'activeTransactions', 'allTransactions'));
    }

   
    public function enter(EnterVehicleRequest $request)
    {
        $validated = $request->validated();

        $location    = ParkirLocation::findOrFail($validated['id_lokasi']);
        $vehicleType = ParkirVehicleType::findOrFail($validated['id_jenis']);

        // ── Check capacity ───────────────────────────────────────────────
        $availableColumn = 'available_' . $vehicleType->jenis; // e.g. available_motorcycle
        if ($location->{$availableColumn} <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kapasitas parkir untuk ' . ucfirst($vehicleType->jenis) . ' di lokasi ini sudah penuh!');
        }

        
        $noTiket = Carbon::now()->format('YmdHis') . $vehicleType->id;

        // ── Generate PDF Ticket ──────────────────────────────────────────
        $jenisLabels = ['motorcycle' => 'Motor', 'car' => 'Mobil', 'other' => 'Lainnya'];
        $pdfData = [
            'no_tiket' => $noTiket,
            'tanggal' => Carbon::now()->format('Y-m-d H:i:s'),
            'location_name' => $location->location_name,
            'vehicle_type_label' => $jenisLabels[$vehicleType->jenis] ?? $vehicleType->jenis,
        ];

        try {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.ticket_pdf', $pdfData);
            
            $ticketsDir = storage_path('app/public/tickets');
            if (!file_exists($ticketsDir)) {
                mkdir($ticketsDir, 0777, true);
            }
            $pdf->save($ticketsDir . '/' . $noTiket . '.pdf');
        } catch (\Exception $e) {
            logger('PDF generation failed: ' . $e->getMessage());
        }

        // ── Decrement available capacity ─────────────────────────────────
        $location->decrement($availableColumn);

        // ── Record the transaction ───────────────────────────────────────
        // Snapshot tariff rates from the vehicle type at time of entry
        ParkirTransaction::create([
            'id_lokasi'        => $location->id,
            'no_tiket'         => $noTiket,
            'no_polisi'        => strtoupper($validated['no_polisi']),
            'id_jenis'         => $vehicleType->id,
            'masuk'            => Carbon::now(),
            'keluar'           => null,
            'perjam_pertama'   => $vehicleType->perjam_pertama,
            'perjam_berikutnya' => $vehicleType->perjam_berikutnya,
            'max_perhari'      => $vehicleType->max_perhari,
            'total_jam'        => null,
            'total_bayar'      => null,
        ]);

        return redirect()->route('transaction.index')
            ->with('success', "Kendaraan {$validated['no_polisi']} berhasil masuk. No. Tiket: {$noTiket}");
    }

    
    public function exit(ExitVehicleRequest $request)
    {
        $validated = $request->validated();

        // Retrieve the active transaction
        $transaction = ParkirTransaction::where('no_tiket', $validated['no_tiket'])
            ->whereNull('keluar')
            ->first();

        if (!$transaction) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Tiket tidak ditemukan atau kendaraan sudah keluar!');
        }

        // ── Record exit time ─────────────────────────────────────────────
        $keluarTime = Carbon::now();
        $masukTime  = Carbon::parse($transaction->masuk);

        $totalMenit = $masukTime->diffInMinutes($keluarTime);
        $totalJam   = max(1, (int) ceil($totalMenit / 60));

        // ── Retrieve tariff snapshot stored at entry time ─────────────────
        $perjamPertama    = $transaction->perjam_pertama;
        $perjamBerikutnya = $transaction->perjam_berikutnya;
        $maxPerhari       = $transaction->max_perhari;

        // ── Apply fee formula ─────────────────────────────────────────────
            if ($totalJam <= 24) {
            // ── Short stay (≤ 24 hours) ──────────────────────────────────
            // Formula: perjam_pertama + perjam_berikutnya * (total_jam - 1)
            $totalBayar = $perjamPertama + ($perjamBerikutnya * ($totalJam - 1));

            // Cap at daily maximum
            if ($totalBayar > $maxPerhari) {
                $totalBayar = $maxPerhari;
            }
            } else {
                // ── Extended stay (> 24 hours) ───────────────────────────────
                // Rate per day = 60% of daily maximum
                $biayaPerHari = $maxPerhari * 0.60;

                // Use full days rounded down
                $totalHari  = (int) floor($totalJam / 24);
                $totalBayar = $biayaPerHari * $totalHari;
            }

        // ── Save the completed transaction ────────────────────────────────
        $transaction->update([
            'no_polisi'  => strtoupper($validated['no_polisi']),
            'keluar'     => $keluarTime,
            'total_jam'  => $totalJam,
            'total_bayar' => (int) $totalBayar,
        ]);

        // ── Restore capacity at the location ─────────────────────────────
        $vehicleType = $transaction->vehicleType;
        if ($vehicleType) {
            $availableColumn = 'available_' . $vehicleType->jenis;
            $location        = $transaction->location;

            if ($location) {
                // Restore one slot, but do not exceed the maximum capacity
                $maxColumn = 'max_' . $vehicleType->jenis;
                $newAvailable = min(
                    $location->{$availableColumn} + 1,
                    $location->{$maxColumn}
                );
                $location->update([$availableColumn => $newAvailable]);
            }
        }

        $formattedTotal = 'Rp ' . number_format((int) $totalBayar, 0, ',', '.');

        return redirect()->route('transaction.index')
            ->with('success', "Kendaraan {$transaction->no_polisi} berhasil keluar. Total Bayar: {$formattedTotal} ({$totalJam} jam)")
            ->with('exit_success', true)
            ->with('total_bayar', $formattedTotal);
    }

    /**
     * AJAX endpoint to look up an active ticket for the exit preview.
     */
    public function lookup(Request $request)
    {
        try {
            $request->validate([
                'no_tiket' => 'nullable|string',
                'no_polisi' => 'nullable|string',
            ]);

            \Log::info('Lookup called', $request->only(['no_tiket','no_polisi']));

            $query = ParkirTransaction::with(['location', 'vehicleType'])
                ->whereNull('keluar');

            if ($request->filled('no_tiket')) {
                $query->where('no_tiket', $request->no_tiket);
            } elseif ($request->filled('no_polisi')) {
                $query->where('no_polisi', strtoupper(trim($request->no_polisi)));
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Masukkan nomor tiket atau nomor polisi.'
                ], 400);
            }

            $transaction = $query->first();

            if (!$transaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kendaraan tidak ditemukan di area parkir.'
                ], 404);
            }

            // ── Calculate estimated fee at lookup time
            //      Total hours = ceil(total_minutes / 60), minimum 1
            $masukTime  = Carbon::parse($transaction->masuk);
            $now        = Carbon::now();
            $totalMenit = $masukTime->diffInMinutes($now);
            $totalJam   = max(1, (int) ceil($totalMenit / 60));

            $perjamPertama    = $transaction->perjam_pertama;
            $perjamBerikutnya = $transaction->perjam_berikutnya;
            $maxPerhari       = $transaction->max_perhari;

            if ($totalJam <= 24) {
                $estimasi = $perjamPertama + ($perjamBerikutnya * ($totalJam - 1));
                if ($estimasi > $maxPerhari) {
                    $estimasi = $maxPerhari;
                }
            } else {
                $biayaPerHari = $maxPerhari * 0.60;
                $totalHari    = (int) floor($totalJam / 24);
                $estimasi     = $biayaPerHari * $totalHari;
            }

            $jenisLabels = ['motorcycle' => 'Motor', 'car' => 'Mobil', 'other' => 'Lainnya'];

            return response()->json([
                'success' => true,
                'data' => [
                    'no_tiket'      => $transaction->no_tiket,
                    'no_polisi'     => $transaction->no_polisi,
                    'jenis_label'   => $jenisLabels[$transaction->vehicleType->jenis ?? 'other'] ?? '-',
                    'lokasi'        => $transaction->location->location_name ?? '-',
                    'masuk'         => $masukTime->format('d/m/Y H:i'),
                    'durasi'        => $totalJam,
                    'estimasi_biaya' => (int) $estimasi,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Lookup error: ' . $e->getMessage(), ['request' => $request->all(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error saat lookup: ' . $e->getMessage()
            ], 500);
        }
    }
}
