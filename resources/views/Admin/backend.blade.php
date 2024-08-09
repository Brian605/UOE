<!doctype html>
<html lang="{{ config('app.locale') }}">

@if(!auth()->check() || !(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('admin')))
    <script>
        window.location.href='/login'
    </script>
@endif
@include('partials.admin_head')


<body>

  <div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">
  @include('partials.sidebar')
  @include('partials.admin_header')


    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
      <div class="content py-0">
        <div class="row fs-sm">
          <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
            Run With <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="https://staging.akgls.org" target="_blank">The Faculty of Agriculture</a>
          </div>
          <div class="col-sm-6 order-sm-1 text-center text-sm-start">
            <a class="fw-semibold" href="https://www.uoeld.ac.ke/" target="_blank">University Of Eldoret</a> &copy;
            <span data-toggle="year-copy"></span>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->
  </div>
  <!-- END Page Container -->
  <script src="{{asset('js/lib/jquery.min.js')}}"></script>
 {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
 --}} @vite(['resources/js/dashmix/app.js'])

  @stack('scripts')

  @if(session('message'))
      <script>
          Swal.fire('{{session('title')}}','{{session('message')}}','{{session('type')}}')
      </script>
  @endif
</body>

</html>
