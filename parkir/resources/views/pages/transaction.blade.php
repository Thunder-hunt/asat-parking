@extends('layouts.app')

@section('title', 'Transaction')
@section('breadcrumb', 'Transaction')
@section('page-title', 'Transaction')

@section('content')

{{-- ============================================================
     ALERT MESSAGES
     ============================================================ --}}
@if (session('success') && !session('exit_success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color:#d1e7dd; color:#0f5132; border-color:#badbcc;">
  <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('exit_success'))
<div id="exitSuccessModal" class="exit-modal-overlay">
  <div class="exit-modal-card">
    <h3 class="exit-modal-title">Total Bayar : {{ session('total_bayar') }}</h3>
    <button class="exit-modal-btn" onclick="closeExitModal()">OK</button>
  </div>
</div>

<style>
.exit-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.4);
  backdrop-filter: blur(4px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999;
}

.exit-modal-card {
  background: #ffffff;
  border-radius: 8px;
  padding: 40px 60px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  text-align: center;
  width: 480px;
  max-width: 90%;
  animation: modalFadeIn 0.3s ease-out;
}

.exit-modal-title {
  color: #2b3e50;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 25px;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

.exit-modal-btn {
  background-color: #b01280;
  color: #ffffff;
  border: 4px solid #e91e63;
  border-radius: 12px;
  padding: 10px 60px;
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.2s ease;
}

.exit-modal-btn:hover {
  background-color: #920e69;
  border-color: #d81b60;
  transform: translateY(-2px);
}

.exit-modal-btn:active {
  transform: translateY(0);
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}
</style>

<script>
function closeExitModal() {
  const modal = document.getElementById('exitSuccessModal');
  if (modal) {
    modal.style.display = 'none';
  }
}
</script>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <ul class="mb-0 ps-3">
    @foreach ($errors->all() as $error)
      <li><i class="fas fa-exclamation-triangle me-2"></i> {{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">

  {{-- ======= LEFT COLUMN: WIDGET, LOCATION CARDS & FORM ======= --}}
  <div class="col-lg-8 mb-4">

    {{-- Top row: Clock + Location Cards --}}
    <div class="d-flex flex-wrap gap-3 mb-4" style="align-items: stretch;">

      {{-- Live Clock & Calendar Widget --}}
      <div class="card shadow-sm border-radius-xl p-3 text-center text-white flex-shrink-0" 
           style="background: linear-gradient(135deg, #141e30 0%, #243b55 100%); width: 185px; border: none;">
        
        {{-- Building Graphic Icon --}}
        <div class="mx-auto mb-2 d-flex align-items-center justify-content-center border-radius-lg" 
             style="width: 60px; height: 60px; background: rgba(255,255,255,0.15);">
          <img src="{{ asset('assets/img/parkir.png') }}" alt="" 
               style="width: 42px; height: 42px; filter: drop-shadow(0px 4px 6px rgba(0,0,0,0.35)); object-fit: contain;">
        </div>
        
        {{-- Day & Date info --}}
        <h6 class="text-white font-weight-bolder mb-0" id="clock-day">Monday</h6>
        <p class="text-xs font-weight-bold text-white mb-3 opacity-8" id="clock-date">8 December 2025</p>
        
        {{-- Live Clock --}}
        <div class="p-2 border-radius-md mt-auto" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
          <h5 class="text-white font-weight-bolder mb-0" id="clock-time" style="letter-spacing: 2px; font-size: 1.2rem;">10:23:51</h5>
        </div>
      </div>

      {{-- Location Capacity Cards --}}
      @foreach ($locations ?? [] as $loc)
      @php
        $parkedMotorcycle = $loc->max_motorcycle - $loc->available_motorcycle;
        $parkedCar        = $loc->max_car        - $loc->available_car;
        $parkedOther      = $loc->max_other      - $loc->available_other;
        $availMoto        = $loc->available_motorcycle;
        $availCar         = $loc->available_car;
        $availOther       = $loc->available_other;
      @endphp
      <div class="card shadow-sm border-radius-xl p-3 text-center flex-shrink-0 cursor-pointer loc-card" 
           data-location-id="{{ $loc->id }}"
           data-location-name="{{ $loc->location_name }}"
           style="width: 180px; border: none; transition: all 0.2s ease;"
           onmouseover="this.style.boxShadow='0 4px 20px rgba(236,64,122,0.25)'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.boxShadow=''; this.style.transform='';"
           onclick="selectLocation(this)">
        
        {{-- Location Icon --}}
        <div class="mx-auto mb-2 d-flex align-items-center justify-content-center border-radius-lg text-white"
             style="width: 52px; height: 52px; background: linear-gradient(135deg, #ec407a 0%, #8e24aa 100%);">
          <i class="fas fa-building" style="font-size: 1.3rem;"></i>
        </div>

        {{-- Location Name --}}
        <h6 class="font-weight-bolder mb-2 text-dark text-sm">{{ $loc->location_name }}</h6>

        {{-- Row 1: Available slots — icon green if available, grey/dim if zero --}}
        <div class="d-flex justify-content-center gap-3 flex-wrap mt-1">
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-motorcycle" style="font-size: 0.85rem; color: {{ $availMoto > 0 ? '#4caf50' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $availMoto > 0 ? '#4caf50' : '#adb5bd' }};">{{ $availMoto }}</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-car" style="font-size: 0.85rem; color: {{ $availCar > 0 ? '#4caf50' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $availCar > 0 ? '#4caf50' : '#adb5bd' }};">{{ $availCar }}</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-truck" style="font-size: 0.85rem; color: {{ $availOther > 0 ? '#4caf50' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $availOther > 0 ? '#4caf50' : '#adb5bd' }};">{{ $availOther }}</span>
          </div>
        </div>

        <hr style="margin: 8px 0; border: 0; border-top: 1px solid #e9ecef; opacity: 0.8;">

        {{-- Row 2: Parked / occupied — icon red if occupied, grey/dim if zero --}}
        <div class="d-flex justify-content-center gap-3 flex-wrap">
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-motorcycle" style="font-size: 0.85rem; color: {{ $parkedMotorcycle > 0 ? '#f44336' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $parkedMotorcycle > 0 ? '#f44336' : '#adb5bd' }};">{{ $parkedMotorcycle }}</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-car" style="font-size: 0.85rem; color: {{ $parkedCar > 0 ? '#f44336' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $parkedCar > 0 ? '#f44336' : '#adb5bd' }};">{{ $parkedCar }}</span>
          </div>
          <div class="d-flex align-items-center gap-2">
            <i class="fas fa-truck" style="font-size: 0.85rem; color: {{ $parkedOther > 0 ? '#f44336' : '#adb5bd' }};"></i>
            <span class="text-xs font-weight-bold" style="color: {{ $parkedOther > 0 ? '#f44336' : '#adb5bd' }};">{{ $parkedOther }}</span>
          </div>
        </div>

      </div>
      @endforeach

    </div>
    {{-- End Top Row --}}

    {{-- Transaction Input Form --}}
    <div class="card shadow-sm border-radius-xl p-4" style="border: none;">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="font-weight-bolder mb-0" style="color: #ec407a;">Transaction <span class="text-secondary font-weight-normal" style="font-size: 1.35rem;">Input Form</span></h5>
        <button type="button" id="btn-submit-exit" class="btn text-white mb-0 font-weight-bold text-xs d-flex align-items-center justify-content-center" style="background-color: #1a2530; border-radius: 8px; letter-spacing: 0.5px; height: 36px; padding: 0 16px;">
          + EXIT VEHICLE
        </button>
      </div>

      <form id="formExitVehicle" action="{{ route('transaction.exit') }}" method="POST">
        @csrf
        <input type="hidden" id="exit_no_tiket" name="no_tiket">
        
        <div class="row">
          {{-- Ticket Number --}}
          <div class="col-md-6 mb-3">
            <label for="no_tiket_input" class="form-label text-xs font-weight-bold text-dark ms-1">Ticket Number</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #ec407a; border-radius: 8px;">
              <input type="text" id="no_tiket_input" class="form-control border-0 bg-transparent py-2 ps-3" placeholder="Masukkan nomor tiket..." style="height: 43px; box-shadow: none; outline: none; border-radius: 8px;">
            </div>
          </div>

          {{-- Police Number --}}
          <div class="col-md-6 mb-3">
            <label for="no_polisi_input" class="form-label text-xs font-weight-bold text-dark ms-1">Police Number</label>
            <div class="input-group input-group-outline bg-white rounded-3" style="border: 1px solid #d2d6da; border-radius: 8px;">
              <input type="text" id="no_polisi_input" name="no_polisi" class="form-control border-0 bg-transparent py-2 ps-3" placeholder="Masukkan nomor polisi..." style="height: 43px; box-shadow: none; outline: none; border-radius: 8px; text-transform: uppercase;">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- ======= RIGHT COLUMN: ACTIVE TICKETS LIST ======= --}}
  <div class="col-lg-4 mb-4">
    <div class="card shadow-sm border-radius-xl h-100" style="border: none; min-height: 450px;">
      <div class="card-header pb-0 bg-transparent d-flex justify-content-between align-items-center mb-3">
        <h5 class="font-weight-bolder mb-0 text-dark">Tickets</h5>
        <button type="button" data-bs-toggle="modal" data-bs-target="#modalAllTransactions" class="btn btn-sm btn-outline-primary mb-0 font-weight-bolder text-xs" style="border-color: #ec407a; color: #ec407a; border-radius: 8px; padding: 4px 16px;">
          VIEW ALL
        </button>
      </div>
      
      <div class="card-body p-3 overflow-auto" style="max-height: 450px;">
        @forelse ($activeTransactions ?? [] as $trx)
          <div class="d-flex justify-content-between align-items-center mb-3 p-3 border-radius-lg cursor-pointer" 
               onclick="selectTicket({{ json_encode($trx->no_tiket) }}, {{ json_encode($trx->no_polisi) }})"
               style="transition: all 0.2s ease; border: 1px solid transparent; background: #f8f9fa;"
               onmouseover="this.style.borderColor='#ec407a'; this.style.backgroundColor='#fff';"
               onmouseout="this.style.borderColor='transparent'; this.style.backgroundColor='#f8f9fa';">
            <div>
              <h6 class="text-sm font-weight-bold mb-0 text-dark">{{ \Carbon\Carbon::parse($trx->masuk)->format('Y-m-d H:i:s') }}</h6>
              <p class="text-xxs text-secondary mb-0">#{{ $trx->no_tiket }}</p>
            </div>
            <div class="text-end">
              <a href="{{ asset('storage/tickets/' . $trx->no_tiket . '.pdf') }}" target="_blank" class="btn btn-link text-dark p-0 mb-0 text-xs font-weight-bold d-flex align-items-center" onclick="event.stopPropagation();">
                <i class="fas fa-file-pdf text-danger fa-lg me-1"></i> PDF
              </a>
            </div>
          </div>
        @empty
          <div class="text-center py-5 text-secondary text-sm">
            <i class="fas fa-parking fa-2x mb-3 text-secondary opacity-5"></i>
            <p class="mb-0">Tidak ada kendaraan parkir.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>

</div>

{{-- ======= HIDDEN FORM: ENTER VEHICLE ======= --}}
<form id="formEnterVehicle" action="{{ route('transaction.enter') }}" method="POST" style="display: none;">
  @csrf
  <input type="hidden" id="modal_id_lokasi" name="id_lokasi">
  <input type="hidden" id="selected_id_jenis" name="id_jenis">
  <input type="hidden" id="enter_no_polisi" name="no_polisi">
</form>

{{-- ======= MODAL: ALL TRANSACTIONS ======= --}}
<div class="modal fade" id="modalAllTransactions" tabindex="-1" role="dialog" aria-labelledby="modalAllTransactionsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content border-radius-xl shadow-lg" style="border: none;">
      <div class="modal-header border-bottom-0 py-3 px-4">
        <h5 class="modal-title font-weight-bolder text-dark" id="modalAllTransactionsLabel">
          All Transactions
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(0); border: none; background: none; box-shadow: none;"></button>
      </div>
      <div class="modal-body p-4">
        <div class="table-responsive p-0" style="max-height: 400px; overflow-y: auto;">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">NO.</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TICKET NUMBER</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">POLICE NUMBER</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">LOCATION NAME</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">VEHICLE TYPE</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TIME IN</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TIME OUT</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">FIRST HOUR CHARGES</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">NEXT HOURLY CHARGES</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">MAX COST PER DAY</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs text-center" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TOTAL HOURS</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs text-center" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TOTAL DAYS</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-3 text-xxs" style="color: #ec407a; border-bottom: 1px solid #f0f2f5;">TOTAL PAYS</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($allTransactions ?? [] as $trx)
              @php
                $masuk = \Carbon\Carbon::parse($trx->masuk);
                $keluar = $trx->keluar ? \Carbon\Carbon::parse($trx->keluar) : null;
                
                // Calculate hours/days
                if ($keluar) {
                    $totalMenit = $masuk->diffInMinutes($keluar);
                    $totalJam = max(1, $totalMenit);
                    $totalHari = (int) floor($totalJam / 24);
                } else {
                    $totalJam = '-';
                    $totalHari = '-';
                }
                
                $jenisLabels = ['motorcycle' => 'motorcycle', 'car' => 'car', 'other' => 'other'];
                $vehicleLabel = $jenisLabels[$trx->vehicleType->jenis ?? ''] ?? ($trx->vehicleType->jenis ?? '-');
              @endphp
              <tr style="border-bottom: 1px solid #f0f2f5;">
                <td class="ps-3 text-sm font-weight-bold text-dark">{{ $loop->iteration }}.</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">
                  <div class="d-flex align-items-center">
                    <a href="{{ asset('storage/tickets/' . $trx->no_tiket . '.pdf') }}" target="_blank" class="btn btn-link text-dark p-0 mb-0 text-xs font-weight-bold me-2">
                      <i class="fas fa-file-pdf text-danger fa-lg"></i> PDF
                    </a>
                    <span>{{ $trx->no_tiket }}</span>
                  </div>
                </td>
                <td class="ps-3 text-sm font-weight-bold text-dark">{{ $trx->no_polisi ?? '-' }}</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">{{ $trx->location->location_name ?? '-' }}</td>
                <td class="ps-3 text-sm text-secondary">{{ $vehicleLabel }}</td>
                <td class="ps-3 text-sm text-secondary">{{ $trx->masuk }}</td>
                <td class="ps-3 text-sm text-secondary">{{ $trx->keluar ?? '-' }}</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">Rp {{ number_format($trx->perjam_pertama, 0, ',', '.') }}</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">Rp {{ number_format($trx->perjam_berikutnya, 0, ',', '.') }}</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">Rp {{ number_format($trx->max_perhari, 0, ',', '.') }}</td>
                <td class="ps-3 text-sm text-center font-weight-bold text-dark">{{ $totalJam }}</td>
                <td class="ps-3 text-sm text-center font-weight-bold text-dark">{{ $totalHari }}</td>
                <td class="ps-3 text-sm font-weight-bold text-dark">{{ $trx->total_bayar ? 'Rp ' . number_format($trx->total_bayar, 0, ',', '.') : '-' }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="13" class="text-center py-4 text-secondary text-sm">No transactions found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4">
        <button type="button" class="btn text-white mb-0" data-bs-dismiss="modal" style="background-color: #1a2530; border-radius: 8px;">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  // ============================================================
  // Live Clock Functionality
  // ============================================================
  function updateClock() {
    const now = new Date();
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
    const dayName = days[now.getDay()];
    const dateStr = now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
    
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const timeStr = `${hours} : ${minutes} : ${seconds}`;
    
    const dayEl = document.getElementById('clock-day');
    const dateEl = document.getElementById('clock-date');
    const timeEl = document.getElementById('clock-time');

    if (dayEl) dayEl.textContent = dayName;
    if (dateEl) dateEl.textContent = dateStr;
    if (timeEl) timeEl.textContent = timeStr;
  }
  setInterval(updateClock, 1000);
  updateClock();

  // Ticket — fill Ticket Number and Police Number automatically when a ticket is clicked
  function selectTicket(noTiket, noPolisi) {
    document.getElementById('no_tiket_input').value = noTiket;
    document.getElementById('no_polisi_input').value = noPolisi || '';
    document.getElementById('exit_no_tiket').value = noTiket;
    
    // Highlight ticket and police input borders temporarily
    const ticketGroup = document.getElementById('no_tiket_input').closest('.input-group');
    const policeGroup = document.getElementById('no_polisi_input').closest('.input-group');
    ticketGroup.style.borderColor = '#8e24aa';
    policeGroup.style.borderColor = '#8e24aa';
    setTimeout(() => {
      ticketGroup.style.borderColor = '#ec407a';
      policeGroup.style.borderColor = '#d2d6da';
    }, 500);

    // Scroll to form smoothly
    document.getElementById('formExitVehicle').scrollIntoView({ behavior: 'smooth', block: 'center' });
  }

  // Keep track of selected vehicle type id
  let selectedVehicleTypeId = null;

  // Location Card — only highlight card and fill dropdown, do NOT open modal automatically
  function selectLocation(card) {
    // Remove active highlight from all cards
    document.querySelectorAll('.loc-card').forEach(c => {
      c.style.border = 'none';
      c.style.outline = '';
    });

    // Highlight selected card with pink border
    card.style.border = '2px solid #ec407a';

    // Pre-select the location in the Enter Vehicle modal dropdown
    const locationId = card.getAttribute('data-location-id');
    const select = document.getElementById('modal_id_lokasi');
    if (select) {
      select.value = locationId;
    }
  }

  // ============================================================
  // Vehicle Type Selection from Navbar — pre-select type in modal & highlight button, do NOT open modal
  // ============================================================
  document.querySelectorAll('.btn-vehicle-type-select').forEach(button => {
    button.addEventListener('click', function() {
      const typeId = this.getAttribute('data-type-id');
      selectedVehicleTypeId = typeId;

      // Reset style of all vehicle type buttons in navbar
      document.querySelectorAll('.btn-vehicle-type-select').forEach(btn => {
        btn.style.backgroundColor = '#344767'; // default background
        btn.style.border = 'none';
      });

      // Highlight the selected button in navy/dark purple style
      this.style.backgroundColor = '#1a2530'; // active darker background
      this.style.border = '1px solid #ec407a'; // subtle highlight border

      // Pre-select the vehicle type inside the hidden form
      const inputJenis = document.getElementById('selected_id_jenis');
      if (inputJenis) {
        inputJenis.value = typeId;
      }
    });
  });

  // ============================================================
  // ENTER VEHICLE Button from Navbar — validate location, vehicle type, AND police number
  // ============================================================
  document.getElementById('btn-trigger-enter-vehicle')?.addEventListener('click', function() {
    // Check location selection
    const selectLocationEl = document.getElementById('modal_id_lokasi');
    if (!selectLocationEl || !selectLocationEl.value) {
      Swal.fire({
        title: 'Lokasi Belum Dipilih',
        text: 'Silakan pilih lokasi gedung parkir terlebih dahulu dengan mengklik salah satu kartu gedung di bawah!',
        icon: 'warning',
        confirmButtonColor: '#8e24aa'
      });
      return;
    }

    // Check vehicle type selection
    const inputJenis = document.getElementById('selected_id_jenis');
    if (!inputJenis || !inputJenis.value) {
      Swal.fire({
        title: 'Tipe Kendaraan Belum Dipilih',
        text: 'Silakan pilih jenis kendaraan (MOTORCYCLE, CAR, atau OTHER) pada tombol navbar di atas terlebih dahulu!',
        icon: 'warning',
        confirmButtonColor: '#8e24aa'
      });
      return;
    }

    // Check police number (no_polisi_input) — required before entry
    const noPolisiVal = document.getElementById('no_polisi_input').value.trim();
    if (!noPolisiVal) {
      Swal.fire({
        title: 'Nomor Polisi Belum Diisi',
        text: 'Silakan masukkan Nomor Polisi kendaraan pada kolom Police Number terlebih dahulu!',
        icon: 'warning',
        confirmButtonColor: '#8e24aa'
      });
      // Highlight the police number input
      const polisiGroup = document.getElementById('no_polisi_input').closest('.input-group');
      if (polisiGroup) {
        polisiGroup.style.borderColor = '#ec407a';
        document.getElementById('no_polisi_input').focus();
      }
      return;
    }

    // Pass police number into the enter form
    document.getElementById('enter_no_polisi').value = noPolisiVal.toUpperCase();

    // Directly submit the form to record entry
    document.getElementById('formEnterVehicle')?.submit();
  });

  // EXIT VEHICLE button — simplified: validate and submit immediately
  document.getElementById('btn-submit-exit')?.addEventListener('click', function() {
    const noTiketVal = document.getElementById('no_tiket_input').value.trim();
    let noPolisiVal = document.getElementById('no_polisi_input').value.trim();

    if (!noTiketVal) {
      Swal.fire({
        title: 'Input Required',
        text: 'Silakan masukkan atau pilih Nomor Tiket terlebih dahulu.',
        icon: 'warning',
        confirmButtonColor: '#8e24aa'
      });
      return;
    }

    if (!noPolisiVal) {
      Swal.fire({
        title: 'Input Required',
        text: 'Silakan masukkan Nomor Polisi terlebih dahulu.',
        icon: 'warning',
        confirmButtonColor: '#8e24aa'
      });
      return;
    }

    noPolisiVal = noPolisiVal.toUpperCase();
    document.getElementById('no_polisi_input').value = noPolisiVal;
    document.getElementById('exit_no_tiket').value = noTiketVal;

    // Directly submit the exit form so the server handles fee calculation and exit logic
    document.getElementById('formExitVehicle').submit();
  });
</script>
@endpush
