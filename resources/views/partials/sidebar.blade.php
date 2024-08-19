<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="fw-semibold text-white tracking-wide" href="/">
            <span class="smini-visible">
              <img class="rounded" width="150"
                   src="{{asset('https://www.uoeld.ac.ke/themes/uoeld/logo.png')}}">
            </span>
                <span class="smini-hidden">
              <img class="rounded"
                   width="150" src="{{asset('https://www.uoeld.ac.ke/themes/uoeld/logo.png')}}">
            </span>
            </a>
            <!-- END Logo -->

            <!-- Options -->
            <div>
                <!-- Toggle Sidebar Style -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on" onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                    <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                </button>
                <!-- END Toggle Sidebar Style -->

                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#dark-mode-toggler" data-class="far fa" onclick="Dashmix.layout('dark_mode_toggle');">
                    <i class="far fa-moon" id="dark-mode-toggler"></i>
                </button>
                <!-- END Dark Mode -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout" data-action="sidebar_close">
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
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="nav-main-link-icon fa fa-home"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-heading">Users</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('users') ? ' active' : '' }} " href="/users">
                        <i class="nav-main-link-icon fa fa-user-secret"></i>
                        <span class="nav-main-link-name">Staff</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('team') ? ' active' : '' }} " href="/team">
                        <i class="nav-main-link-icon fa fa-users"></i>
                        <span class="nav-main-link-name">Team</span>
                    </a>
                </li>

                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('departments') ? ' active' : '' }} " href="/departments">
                        <i class="nav-main-link-icon fa fa-network-wired"></i>
                        <span class="nav-main-link-name">Departments</span>
                    </a>
                </li>

                <li class="nav-main-heading">Crops</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('crops/lists') ? ' active' : '' }} " href="/crops/lists">
                        <i class="nav-main-link-icon fa fa-tree"></i>
                        <span class="nav-main-link-name">All Crops</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('crops/categories') ? ' active' : '' }} " href="/crops/categories">
                        <i class="nav-main-link-icon fa fa-network-wired"></i>
                        <span class="nav-main-link-name">Categories</span>
                    </a>
                </li>

                <hr class="w-100"/>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('farm/plans') ? ' active' : '' }} " href="/farm/plans">
                        <i class="nav-main-link-icon fa fa-compass-drafting"></i>
                        <span class="nav-main-link-name">Farm Plans</span>
                    </a>
                </li>
                <hr class="w-100"/>


                <li class="nav-main-heading">Livestock</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('livestock/list') ? ' active' : '' }} " href="/livestock/list">
                        <i class="nav-main-link-icon fa fa-list"></i>
                        <span class="nav-main-link-name">All Livestock</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('livestock/types') ? ' active' : '' }} " href="/livestock/types">
                        <i class="nav-main-link-icon fa fa-network-wired"></i>
                        <span class="nav-main-link-name">Types</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('livestock/categories') ? ' active' : '' }} " href="/livestock/categories">
                        <i class="nav-main-link-icon fa fa-cow"></i>
                        <span class="nav-main-link-name">Categories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('livestock/breeds') ? ' active' : '' }} " href="/livestock/breeds">
                        <i class="nav-main-link-icon fa fa-cow"></i>
                        <span class="nav-main-link-name">Breeds</span>
                    </a>
                </li>

                <li class="nav-main-heading">Finance</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('finance/expenses') ? ' active' : '' }} " href="/finance/expenses">
                        <i class="nav-main-link-icon fa fa-wallet"></i>
                        <span class="nav-main-link-name">Expenditures</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('finance/income') ? ' active' : '' }} " href="/finance/income">
                        <i class="nav-main-link-icon fa fa-money-bills"></i>
                        <span class="nav-main-link-name">Income</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('finance/receipts') ? ' active' : '' }} " href="/finance/receipts">
                        <i class="nav-main-link-icon fa fa-receipt"></i>
                        <span class="nav-main-link-name">Receipts</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('finance/budgeting') ? ' active' : '' }} " href="/finance/budgeting">
                        <i class="nav-main-link-icon fa fa-piggy-bank"></i>
                        <span class="nav-main-link-name">Budgeting</span>
                    </a>
                </li>

                <li class="nav-main-heading">Procurement</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('procurement/list') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-clipboard-list"></i>
                        <span class="nav-main-link-name">Procurement</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('inventory/list') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-box-open"></i>
                        <span class="nav-main-link-name">Inventory</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('inventory/categories') ? ' active' : '' }} " href="/inventory/categories">
                        <i class="nav-main-link-icon fa fa-boxes"></i>
                        <span class="nav-main-link-name">Item Categories</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('inventory/uoms') ? ' active' : '' }} " href="/inventory/uoms">
                        <i class="nav-main-link-icon fa fa-ruler"></i>
                        <span class="nav-main-link-name">Units Of Measurement</span>
                    </a>
                </li>

                <hr class="w-100"/>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('research') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-project-diagram"></i>
                        <span class="nav-main-link-name">Research Projects</span>
                    </a>
                </li>
                <hr class="w-100"/>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('reports') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-chart-line"></i>
                        <span class="nav-main-link-name">Reports</span>
                    </a>
                </li>
                <li class="nav-main-heading">News and Media</li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('/admin/blogs') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-book"></i>
                        <span class="nav-main-link-name">Blogs</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('/admin/gallery') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-images"></i>
                        <span class="nav-main-link-name">Gallery</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('/admin/downloads') ? ' active' : '' }} " href="/">
                        <i class="nav-main-link-icon fa fa-download"></i>
                        <span class="nav-main-link-name">Downloads</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
