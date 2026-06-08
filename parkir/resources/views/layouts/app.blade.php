<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <title>@yield('title', 'Dashboard')</title>

  {{-- Fonts & Icons --}}
  <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  {{-- Font Awesome --}}
  <script src="{{ asset('assets/js/plugins/all.js') }}" crossorigin="anonymous"></script>

  {{-- Soft UI Dashboard Core CSS --}}
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.min.css') }}" rel="stylesheet" />

  {{-- SweetAlert --}}
  <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}">

  @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">

  {{-- ========== SIDEBAR ========== --}}
  @include('partials.sidebar')

  {{-- ========== MAIN CONTENT ========== --}}
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    {{-- Top Navbar --}}
    @include('partials.navbar')

    {{-- Page Content --}}
    <div class="container-fluid py-4">
      @yield('content')

      {{-- Footer --}}
      @include('partials.footer')
    </div>

  </main>

  {{-- Core JS --}}
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/sweetalert.js') }}"></script>
  <script>
    // Global polyfill for SweetAlert v1 to support Swal.fire API
    if (typeof swal !== 'undefined' && typeof Swal === 'undefined') {
      window.Swal = {
        fire: function(options) {
          if (typeof options === 'object') {
            if (options.icon && !options.type) {
              options.type = options.icon;
            }
            // Map common configurations
            if (options.didOpen) {
              setTimeout(options.didOpen, 100);
            }
            return swal(options);
          }
          return swal.apply(window, arguments);
        },
        showLoading: function() {
          if (typeof swal.disableButtons === 'function') {
            swal.disableButtons();
          }
        },
        close: function() {
          if (typeof swal.close === 'function') {
            swal.close();
          }
        }
      };
    }
  </script>

  {{-- Soft UI Dashboard Main JS --}}
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js') }}"></script>

  <script>
    // Initialize scrollbar on Windows
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = { damping: '0.5' }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  @stack('scripts')

</body>
</html>
