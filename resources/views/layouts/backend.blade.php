<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>UOE Farm Management System</title>

    <meta name="description"
          content="Welcome to the UOE Farm Management System. Login to manage different aspects of the farm.">
    <meta name="author" content="Return 0;">
    <meta name="robots" content="index,follow">

    <!-- Icons -->
    <link rel="shortcut icon" href="https://www.uoeld.ac.ke/themes/uoeld/favicon.ico">
    <link rel="icon" sizes="192x192" type="image/png" href="https://www.uoeld.ac.ke/themes/uoeld/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.uoeld.ac.ke/themes/uoeld/favicon/apple-touch-icon.png">

    <!-- Modules -->
    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js', 'resources/js/app.js'])

    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/dashmix/themes/xwork.scss', 'resources/js/dashmix/app.js']) --}}
    @yield('js')
</head>

<body>
@php
    $links = [
        [
            "name" =>  "Dashboard",
            "active" => request()->routeIs('dashboard'),
            "url" => "dashboard",
            "icon" => "fa fa-home"
        ],
        [
            "name" =>  "Crops",
            "active" => request()->routeIs('Crops.index'),
            "url" => "Crops.index",
            "icon" => "fa fa-tree"
        ],
        [
            "name" =>  "Farm Plans",
            "active" => request()->routeIs('farm-plans.index'),
            "url" => "farm-plans.index",
            "icon" => "fa fa-book"
        ],
        [
            "name" =>  "Finance",
            "active" => request()->routeIs('finances.index'),
            "url" => "finances.index",
            "icon" => "fa fa-usd"
        ],
        [
            "name" =>  "Live stocks",
            "active" => request()->routeIs('livestocks.index'),
            "url" => "livestocks.index",
            "icon" => "fa fa-cow"
        ],
        [
            "name" =>  "Procurement",
            "active" => request()->routeIs('procurements.index'),
            "url" => "procurements.index",
            "icon" => "fa fa-balance-scale"
        ],
        [
            "name" =>  "Research",
            "active" => request()->routeIs('research.index'),
            "url" => "research.index",
            "icon" => "fa fa-search"
        ],
        [
            "name" =>  "Units",
            "active" => request()->routeIs('units.index'),
            "url" => "units.index",
            "icon" => "fa fa-unity"
        ],
        [
            "name" =>  "Inventory",
            "active" => request()->routeIs('inventory.index'),
            "url" => "inventory.index",
            "icon" => "fa fa-product-hunt"
        ],
        [
            "name" =>  "Users",
            "active" => request()->routeIs('users.index'),
            "url" => "users.index",
            "icon" => "fa fa-user-circle"
        ],
        [
            "name" =>  "Roles",
            "active" => request()->routeIs('roles.index'),
            "url" => "roles.index",
            "icon" => "fa fa-user-circle"
        ],
        [
            "name" =>  "Permissions",
            "active" => request()->routeIs('permissions.index'),
            "url" => "permissions.index",
            "icon" => "fa fa-user-circle"
        ],

    ];

@endphp

<div id="page-container"
     class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">

    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="bg-header-dark">
            <div class="content-header bg-white-5">
                <!-- Logo -->
                <a class="fw-semibold text-white tracking-wide" href="/">
            <span class="smini-visible">
              U<span class="opacity-75">E</span>
            </span>
                    <span class="smini-hidden">
              UOE <span class="opacity-75">FMS</span>
            </span>
                </a>
                <!-- END Logo -->

                <!-- Options -->
                <div>
                    <!-- Toggle Sidebar Style -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                            onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                        <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                    </button>
                    <!-- END Toggle Sidebar Style -->

                    <!-- Dark Mode -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#dark-mode-toggler" data-class="far fa"
                            onclick="Dashmix.layout('dark_mode_toggle');">
                        <i class="far fa-moon" id="dark-mode-toggler"></i>
                    </button>
                    <!-- END Dark Mode -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                        <i class="fa fa-times-circle"></i>
                    </button>
                    <!-- END Close Sidebar -->
                </div>
                <!-- END Options -->
            </div>
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    @foreach($links as $link)
                        @can($link['url'])
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ $link['active'] ? ' active' : '' }}"
                               href="{{ route($link['url']) }}">
                                <i class="nav-main-link-icon {{ $link['icon'] }}"></i>
                                <span class="nav-main-link-name">{{ $link['name']  }}</span>
{{--                                <span class="nav-main-link-badge badge rounded-pill bg-primary">5</span>--}}
                            </a>
                        </li>
                        @endcan
                    @endforeach
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="space-x-1">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

                <!-- Open Search Section -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-alt-secondary" data-toggle="layout" data-action="header_search_on">
                    <i class="fa fa-fw opacity-50 fa-search"></i> <span
                        class="ms-1 d-none d-sm-inline-block">Search</span>
                </button>
                <!-- END Open Search Section -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="space-x-1">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">{{ \Illuminate\Support\Facades\Auth::user()->name
                        }}</span>
                        <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                            User Options
                        </div>
                        <div class="p-2">
                           <div>
                               <form action="{{ route('logout') }}" method="post">
                                   @csrf
                                   <button type="submit" class="btn btn-danger w-100">Logout</button>
                               </form>
                           </div>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Notifications Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-alt-secondary" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-notifications-dropdown">
                        <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                            Notifications
                        </div>
                        <ul class="nav-items my-2">
                            <li>
                                <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 mx-3">
                                        <i class="fa fa-fw fa-check-circle text-success"></i>
                                    </div>
                                    <div class="flex-grow-1 fs-sm pe-2">
                                        <div class="fw-semibold">App was updated to v5.6!</div>
                                        <div class="text-muted">3 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 mx-3">
                                        <i class="fa fa-fw fa-user-plus text-info"></i>
                                    </div>
                                    <div class="flex-grow-1 fs-sm pe-2">
                                        <div class="fw-semibold">New Subscriber was added! You now have 2580!
                                        </div>
                                        <div class="text-muted">10 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 mx-3">
                                        <i class="fa fa-fw fa-times-circle text-danger"></i>
                                    </div>
                                    <div class="flex-grow-1 fs-sm pe-2">
                                        <div class="fw-semibold">Server backup failed to complete!</div>
                                        <div class="text-muted">30 min ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 mx-3">
                                        <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 fs-sm pe-2">
                                        <div class="fw-semibold">You are running out of space. Please consider
                                            upgrading your plan.
                                        </div>
                                        <div class="text-muted">1 hour ago</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                    <div class="flex-shrink-0 mx-3">
                                        <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1 fs-sm pe-2">
                                        <div class="fw-semibold">New Sale! + $30</div>
                                        <div class="text-muted">2 hours ago</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="p-2 border-top">
                            <a class="btn btn-alt-primary w-100 text-center" href="javascript:void(0)">
                                <i class="fa fa-fw fa-eye opacity-50 me-1"></i> View All
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Notifications Dropdown -->

                <!-- Toggle Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-alt-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                    <i class="far fa-fw fa-list-alt"></i>
                </button>
                <!-- END Toggle Side Overlay -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-header-dark">
            <div class="content-header">
                <form class="w-100" action="/dashboard" method="POST">
                    @csrf
                    <div class="input-group">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-alt-primary" data-toggle="layout"
                                data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                        <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
                               id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-header-dark">
            <div class="bg-white-10">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
            <div class="row fs-sm">

                <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                    <a class="fw-semibold" href="/" target="_blank">UOE Farm Management System</a> &copy;
                    <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->
</body>

</html>
