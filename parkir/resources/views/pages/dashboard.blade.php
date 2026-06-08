@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ============================================================
     STAT CARDS ROW - Ringkasan Kapasitas Lokasi
     ============================================================ --}}
<div class="row">

  {{-- Card: Total Lokasi --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Lokasi</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $totalLocations ?? 0 }}
                <span class="text-success text-sm font-weight-bolder">aktif</span>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
              <i class="fas fa-map-marker-alt text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Card: Total Transaksi Hari Ini --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Transaksi Hari Ini</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $todayTransactions ?? 0 }}
                <span class="text-info text-sm font-weight-bolder">kendaraan</span>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
              <i class="fas fa-car text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Card: Kendaraan Saat Ini Parkir --}}
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Sedang Parkir</p>
              <h5 class="font-weight-bolder mb-0">
                {{ $currentlyParked ?? 0 }}
                <span class="text-warning text-sm font-weight-bolder">kendaraan</span>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
              <i class="fas fa-parking text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Card: Total Pendapatan Hari Ini --}}
  <div class="col-xl-3 col-sm-6">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">Pendapatan Hari Ini</p>
              <h5 class="font-weight-bolder mb-0">
                Rp {{ number_format($todayRevenue ?? 0, 0, ',', '.') }}
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
              <i class="fas fa-money-bill-wave text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
{{-- END STAT CARDS ROW --}}

{{-- ============================================================
     LOCATION CAPACITY CARDS
     ============================================================ --}}
<div class="row mt-4">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="font-weight-bolder mb-0">Kapasitas Lokasi Parkir</h6>
            <p class="text-sm text-secondary mb-0">Sisa kapasitas kendaraan per lokasi saat ini</p>
          </div>
          <a href="{{ route('location.index') }}" class="btn btn-sm btn-outline-primary mb-0">
            <i class="fas fa-cogs me-1"></i> Kelola Lokasi
          </a>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  <i class="fas fa-motorcycle me-1 text-info"></i> Motor
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  <i class="fas fa-car me-1 text-warning"></i> Mobil
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                  <i class="fas fa-truck me-1 text-danger"></i> Lainnya
                </th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($locations ?? [] as $loc)
              <tr>
                <td class="ps-4">
                  <div class="d-flex flex-column">
                    <h6 class="mb-0 text-sm font-weight-bolder">{{ $loc->location_name }}</h6>
                  </div>
                </td>

                {{-- Motor capacity bar --}}
                <td class="text-center">
                  @php
                    $motoPercent = $loc->max_motorcycle > 0
                      ? round(($loc->available_motorcycle / $loc->max_motorcycle) * 100)
                      : 0;
                    $motoColor = $motoPercent > 50 ? 'bg-gradient-success' : ($motoPercent > 20 ? 'bg-gradient-warning' : 'bg-gradient-danger');
                  @endphp
                  <div class="d-flex flex-column align-items-center">
                    <span class="text-xs font-weight-bold mb-1">
                      <strong>{{ $loc->available_motorcycle }}</strong> / {{ $loc->max_motorcycle }}
                    </span>
                    <div class="progress w-75" style="height: 6px;">
                      <div class="progress-bar {{ $motoColor }}"
                           role="progressbar"
                           style="width: {{ $motoPercent }}%;"
                           aria-valuenow="{{ $motoPercent }}"
                           aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                </td>

                {{-- Car capacity bar --}}
                <td class="text-center">
                  @php
                    $carPercent = $loc->max_car > 0
                      ? round(($loc->available_car / $loc->max_car) * 100)
                      : 0;
                    $carColor = $carPercent > 50 ? 'bg-gradient-success' : ($carPercent > 20 ? 'bg-gradient-warning' : 'bg-gradient-danger');
                  @endphp
                  <div class="d-flex flex-column align-items-center">
                    <span class="text-xs font-weight-bold mb-1">
                      <strong>{{ $loc->available_car }}</strong> / {{ $loc->max_car }}
                    </span>
                    <div class="progress w-75" style="height: 6px;">
                      <div class="progress-bar {{ $carColor }}"
                           role="progressbar"
                           style="width: {{ $carPercent }}%;"
                           aria-valuenow="{{ $carPercent }}"
                           aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                </td>

                {{-- Other capacity bar --}}
                <td class="text-center">
                  @php
                    $othPercent = $loc->max_other > 0
                      ? round(($loc->available_other / $loc->max_other) * 100)
                      : 0;
                    $othColor = $othPercent > 50 ? 'bg-gradient-success' : ($othPercent > 20 ? 'bg-gradient-warning' : 'bg-gradient-danger');
                  @endphp
                  <div class="d-flex flex-column align-items-center">
                    <span class="text-xs font-weight-bold mb-1">
                      <strong>{{ $loc->available_other }}</strong> / {{ $loc->max_other }}
                    </span>
                    <div class="progress w-75" style="height: 6px;">
                      <div class="progress-bar {{ $othColor }}"
                           role="progressbar"
                           style="width: {{ $othPercent }}%;"
                           aria-valuenow="{{ $othPercent }}"
                           aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                </td>

                {{-- Overall status badge --}}
                <td class="text-center">
                  @php
                    $totalAvail = $loc->available_motorcycle + $loc->available_car + $loc->available_other;
                    $totalMax   = $loc->max_motorcycle + $loc->max_car + $loc->max_other;
                    $overallPct = $totalMax > 0 ? round(($totalAvail / $totalMax) * 100) : 0;
                  @endphp
                  @if ($overallPct > 50)
                    <span class="badge badge-sm bg-gradient-success">Tersedia</span>
                  @elseif ($overallPct > 10)
                    <span class="badge badge-sm bg-gradient-warning">Hampir Penuh</span>
                  @else
                    <span class="badge badge-sm bg-gradient-danger">Penuh</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-4 text-secondary text-sm">
                  <i class="fas fa-inbox fa-2x mb-2 d-block opacity-5"></i>
                  Belum ada data lokasi parkir.
                  <a href="{{ route('location.index') }}" class="text-primary">Tambah sekarang</a>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ============================================================
     RECENT TRANSACTIONS TABLE
     ============================================================ --}}
<div class="row mt-2">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <div>
          <h6 class="font-weight-bolder mb-0">Transaksi Terbaru</h6>
          <p class="text-sm text-secondary mb-0">10 transaksi terakhir</p>
        </div>
        <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-outline-primary mb-0">
          Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
        </a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. Tiket</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No. Polisi</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Masuk</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keluar</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Bayar</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($recentTransactions ?? [] as $trx)
              <tr>
                <td class="ps-4">
                  <span class="text-xs font-weight-bold">{{ $trx->no_tiket }}</span>
                </td>
                <td>
                  <span class="text-xs text-secondary">{{ $trx->location->location_name ?? '-' }}</span>
                </td>
                <td>
                  <span class="badge badge-sm bg-gradient-secondary">{{ $trx->no_polisi }}</span>
                </td>
                <td class="text-center">
                  @php
                    $jenisLabel = ['motorcycle' => 'Motor', 'car' => 'Mobil', 'other' => 'Lainnya'];
                    $jenisBadge = ['motorcycle' => 'bg-gradient-info', 'car' => 'bg-gradient-warning', 'other' => 'bg-gradient-secondary'];
                    $j = $trx->vehicleType->jenis ?? 'other';
                  @endphp
                  <span class="badge badge-sm {{ $jenisBadge[$j] ?? 'bg-gradient-secondary' }}">
                    {{ $jenisLabel[$j] ?? $j }}
                  </span>
                </td>
                <td class="text-center">
                  <span class="text-xs text-secondary">{{ \Carbon\Carbon::parse($trx->masuk)->format('d/m/Y H:i') }}</span>
                </td>
                <td class="text-center">
                  @if ($trx->keluar)
                    <span class="text-xs text-secondary">{{ \Carbon\Carbon::parse($trx->keluar)->format('d/m/Y H:i') }}</span>
                  @else
                    <span class="badge badge-sm bg-gradient-primary">Parkir</span>
                  @endif
                </td>
                <td class="text-center">
                  @if ($trx->total_bayar !== null)
                    <span class="text-xs font-weight-bold text-success">
                      Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                    </span>
                  @else
                    <span class="text-xs text-secondary">-</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-secondary text-sm">
                  <i class="fas fa-inbox fa-2x mb-2 d-block opacity-5"></i>
                  Belum ada transaksi.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
