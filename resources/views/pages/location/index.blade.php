@extends('layouts.app')

@section('title', 'Location')
@section('breadcrumb', 'Location')
@section('page-title', 'Location')

@section('content')

<div class="row">
  {{-- ======= LOCATIONS TABLE (FULL WIDTH) ======= --}}
  <div class="col-12">
    <div class="card mb-4 shadow-sm border-radius-xl" style="border: none;">
      <div class="card-header pb-0 bg-transparent">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h4 class="font-weight-bolder mb-1" style="color: #ec407a;">Location <span class="text-secondary font-weight-normal" style="font-size: 1.35rem;">Data Table</span></h4>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-4" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">NO.</th>
                <th class="text-uppercase font-weight-bolder opacity-9 ps-4" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">LOCATION NAME</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">MAX MOTORCYCLE</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">MAX CAR</th>
                <th class="text-center text-uppercase font-weight-bolder opacity-9" style="color: #ec407a; font-size: 0.75rem; letter-spacing: 0.5px; border-bottom: 1px solid #f0f2f5;">MAX TRUCK/BUS/OTHER</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($locations as $loc)
              <tr style="border-bottom: 1px solid #f0f2f5;">
                <td class="ps-4">
                  <span class="text-sm font-weight-bold text-dark">{{ $loop->iteration }}.</span>
                </td>
                <td class="ps-4">
                  <div class="d-flex align-items-center">
                    <a href="{{ route('location.edit', $loc->id) }}" class="text-info font-weight-bolder text-xs me-3 d-flex align-items-center text-uppercase" style="letter-spacing: 0.5px; text-decoration: none; box-shadow: none;">
                      <i class="fas fa-pencil-alt me-1" style="font-size: 10px;"></i> EDIT
                    </a>
                    <span class="text-sm font-weight-bold text-dark">{{ $loc->location_name }}</span>
                  </div>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">{{ $loc->max_motorcycle }}</span>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">{{ $loc->max_car }}</span>
                </td>
                <td class="text-center">
                  <span class="text-sm font-weight-bold text-dark">{{ $loc->max_other }}</span>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center py-5 text-secondary text-sm">
                  <i class="fas fa-map-marker-alt fa-2x mb-3 d-block mx-auto opacity-5" style="color: #ec407a;"></i>
                  Belum ada lokasi parkir. Klik <strong>+ ADD NEW LOCATION</strong> di atas untuk menambahkan.
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
