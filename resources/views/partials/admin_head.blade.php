<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Admin|UOE FMS</title>

    <meta name="description" content="UOE">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <link rel="shortcut icon" href="https://www.uoeld.ac.ke/themes/uoeld/favicon.ico">
    <link rel="icon" sizes="192x192" type="image/png" href="https://www.uoeld.ac.ke/themes/uoeld/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.uoeld.ac.ke/themes/uoeld/favicon/apple-touch-icon.png">

    <!-- Modules -->
    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js'])

    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/dashmix/themes/xwork.scss', 'resources/js/dashmix/app.js']) --}}
    @yield('js')
    <script src="{{asset('js/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
</head>
