<!doctype html>
<html lang="{{ config('app.locale') }}">
@include('partials.admin_head')


<body>
  <div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->
  </div>
  <!-- END Page Container -->
@if(session('message'))
    <script>
        Swal.fire('{{session('title')}}','{{session('message')}}','{{session('type')}}')
    </script>
@endif
</body>

</html>
