<nav class="navbar navbar-main navbar-expand-lg bg-white px-4 py-3 mx-4 mt-3 shadow-sm border-radius-xl" id="navbarBlur" navbar-scroll="true" style="border: none;">
  <div class="container-fluid py-1 px-0">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm text-secondary">
          <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
          @yield('breadcrumb', 'Dashboard')
        </li>
      </ol>
      <h6 class="font-weight-bolder mb-0 text-dark">@yield('page-title', 'Dashboard')</h6>
    </nav>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto d-flex align-items-center justify-content-end w-100 mt-2 mt-md-0">
        
        {{-- Search Input Box --}}
        <div class="pe-md-3 d-flex align-items-center">
          <div class="input-group" style="border: 1px solid #e2e8f0; border-radius: 8px; background-color: #fff; width: 180px; transition: all 0.2s ease;">
            <span class="input-group-text text-secondary bg-transparent border-0 py-2 pe-1 ps-3">
              <i class="fas fa-search" aria-hidden="true" style="font-size: 0.85rem;"></i>
            </span>
            <input type="text" class="form-control border-0 bg-transparent py-1 ps-2 text-xs text-dark" placeholder="Type here..." style="box-shadow: none; outline: none; height: 32px;">
          </div>
        </div>

        {{-- Add New Location Button (Conditional) --}}
        @if (request()->routeIs('location.index'))
        <a href="{{ route('location.create') }}" class="btn text-white font-weight-bolder text-xs mb-0 px-3 py-2 d-flex align-items-center shadow-sm" 
                style="background: linear-gradient(90deg, #ec407a 0%, #8e24aa 100%); border-radius: 8px; letter-spacing: 0.5px; height: 34px; border: none; font-size: 10px;">
          <i class="fas fa-plus me-2" style="font-size: 0.75rem;"></i> ADD NEW LOCATION
        </a>
        @endif

        {{-- Add New Vehicle Type Button (Conditional) --}}
        @if (request()->routeIs('vehicle-type.index'))
        <a href="{{ route('vehicle-type.create') }}" class="btn text-white font-weight-bolder text-xs mb-0 px-3 py-2 d-flex align-items-center shadow-sm" 
                style="background: linear-gradient(90deg, #ec407a 0%, #8e24aa 100%); border-radius: 8px; letter-spacing: 0.5px; height: 34px; border: none; font-size: 10px;">
          <i class="fas fa-plus me-2" style="font-size: 0.75rem;"></i> ADD NEW VEHICLE TYPE
        </a>
        @endif

        {{-- Enter Vehicle Button (Conditional - Transaction Page) --}}
        @if (request()->routeIs('transaction.index'))
          @if (isset($vehicleTypes))
            @foreach ($vehicleTypes as $type)
            <button type="button" class="btn text-white font-weight-bolder text-xs mb-0 px-3 py-2 me-2 d-flex align-items-center shadow-sm btn-vehicle-type-select" 
                    data-type-id="{{ $type->id }}"
                    style="background-color: #344767; border-radius: 8px; letter-spacing: 0.5px; height: 34px; border: none; font-size: 10px;">
              {{ strtoupper($type->jenis) }}
            </button>
            @endforeach
          @endif
        <button type="button" id="btn-trigger-enter-vehicle"
                class="btn text-white font-weight-bolder text-xs mb-0 px-3 py-2 d-flex align-items-center shadow-sm" 
                style="background: linear-gradient(90deg, #ec407a 0%, #8e24aa 100%); border-radius: 8px; letter-spacing: 0.5px; height: 34px; border: none; font-size: 10px;">
          <i class="fas fa-plus me-2" style="font-size: 0.75rem;"></i> ENTER VEHICLE
        </button>
        @endif

        {{-- Sign Out Link --}}
        <div class="ms-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-secondary font-weight-bold px-0 d-flex align-items-center text-sm" style="transition: color 0.2s ease;">
            <i class="fa fa-user me-2 text-secondary" style="font-size: 0.9rem;"></i>
            <span class="d-sm-inline d-none text-secondary font-weight-bolder" style="font-size: 13px;">Sign Out</span>
          </a>
        </div>

        {{-- Mobile Toggler --}}
        <div class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </div>
        
      </div>
    </div>
  </div>
</nav>
