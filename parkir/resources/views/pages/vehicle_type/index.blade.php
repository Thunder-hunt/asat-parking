@extends('layouts.app')

@section('title', 'Vehicle Type')
@section('breadcrumb', 'Vehicle Type')
@section('page-title', 'Vehicle Type')

@section('content')

<div class="row">
  {{-- ======= VEHICLE TYPE TABLE (FULL WIDTH) ======= --}}
  <div class="col-12">
    <div class="card mb-4 shadow-sm border-radius-xl" style="border: none;">
      <div class="card-header pb-0 bg-transparent">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="font-weight-bolder mb-1" style="color: #ec407a;">Vehicle Type <span class="text-secondary font-weight-normal" style="font-size: 1.35rem;">Data Table</span></h4>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-4" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">NO.</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-4" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">VEHICLE TYPE</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">FIRST HOUR CHARGES</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">NEXT HOURLY CHARGES</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">MAX COST PER DAY</th>
              </tr>
            </thead>
            <tbody>
              @php
                $labels = ['motorcycle' => 'Motor', 'car' => 'Mobil', 'other' => 'Lainnya'];
              @endphp
              @forelse ($types as $type)
              <tr style="border-bottom: 1px solid #f0f2f5;">
                <td class="ps-4">
                  <span class="text-sm font-weight-bold text-dark">{{ $loop->iteration }}.</span>
                </td>
                <td class="ps-4">
                  <div class="d-flex align-items-center">
                    <a href="{{ route('vehicle-type.edit', $type->id) }}" class="text-info font-weight-bolder text-xs me-3 d-flex align-items-center text-uppercase" style="letter-spacing: 0.5px; text-decoration: none; box-shadow: none;">
                      <i class="fas fa-pencil-alt me-1" style="font-size: 10px;"></i> EDIT
                    </a>
                    <button class="btn btn-link text-danger font-weight-bolder text-xs mb-0 p-0 me-3 d-flex align-items-center text-uppercase" onclick="deleteVehicleType({{ $type->id }}, '{{ $labels[$type->jenis] ?? $type->jenis }}')" style="border: none; background: none; letter-spacing: 0.5px; box-shadow: none;">
                      <i class="fas fa-trash me-1" style="font-size: 10px;"></i> DELETE
                    </button>
                    <span class="text-sm font-weight-bold text-dark">{{ $labels[$type->jenis] ?? ucfirst($type->jenis) }}</span>
                  </div>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">Rp {{ number_format($type->perjam_pertama, 0, ',', '.') }}</span>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">Rp {{ number_format($type->perjam_berikutnya, 0, ',', '.') }}</span>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">Rp {{ number_format($type->max_perhari, 0, ',', '.') }}</span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-5 text-secondary text-sm">
                  <i class="fas fa-car fa-2x mb-3 d-block mx-auto opacity-5" style="color: #ec407a;"></i>
                  Belum ada data tarif kendaraan. Klik <strong>+ ADD NEW VEHICLE TYPE</strong> di atas untuk menambahkan.
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

@push('scripts')
<script>
function deleteVehicleType(id, name) {
  Swal.fire({
    title: 'Hapus Jenis Kendaraan?',
    html: `Tarif untuk <strong>${name}</strong> akan dihapus permanen.`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, Hapus',
    cancelButtonText: 'Batal',
    confirmButtonColor: '#ea0606',
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/vehicle-type/${id}`;
      form.innerHTML = `@csrf @method('DELETE')`;
      document.body.appendChild(form);
      form.submit();
    }
  });
}
</script>
@if (session('success'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      title: 'Good Job',
      text: "{{ session('success') }}",
      icon: 'success',
      confirmButtonText: 'OK',
      confirmButtonColor: '#8e24aa'
    });
  });
</script>
@endif
@if (session('error'))
<script>
  document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
      title: 'Oops...',
      text: "{{ session('error') }}",
      icon: 'error',
      confirmButtonText: 'OK',
      confirmButtonColor: '#8e24aa'
    });
  });
</script>
@endif
@endpush
