<!-- Header
    ============================================= -->
<header>
    <!-- Start Navigation -->
    <nav class="navbar mobile-sidenav navbar-style-one navbar-sticky navbar-default validnavs white navbar-fixed no-background">

        <div class="container-full d-flex justify-content-between align-items-center">

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="https://www.uoeld.ac.ke/themes/uoeld/logo.png" class="logo desktop" alt="Logo">
                    <img src="https://www.uoeld.ac.ke/themes/uoeld/logo.png" class="logo logo-mobile" alt="Logo">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">

                <img src="https://www.uoeld.ac.ke/themes/uoeld/logo.png" alt="Logo">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-times"></i>
                </button>

                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="">
                        <a href="/" class="{{request()->is('/')?'active':''}}">Home</a>
                    </li>
                    <li class="">
                        <a href="/about" class="{{request()->is('about')?'active':''}}">About Us</a>
                    </li>
                    <li class="">
                        <a href="/team" class="{{request()->is('team')?'active':''}}">Our Team</a>
                    </li>
                    <li class="">
                        <a href="/projects" class="{{request()->is('projects')?'active':''}}">Our Projects</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle {{request()->is('blog') || request()->is('downloads') ||request()->is('gallery')?'active':''}}" data-toggle="dropdown" >News and Media</a>
                        <ul class="dropdown-menu">
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/downloads">Downloads</a></li>
                            <li><a href="/gallery">Gallery</a></li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="/careers" class="{{request()->is('careers')?'active':''}}">Careers</a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->

            <div class="attr-right">
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="">
                            <a href="/admin" class="dropdown-toggle">
                                <i class="far fa-user-circle"></i>
                                <span class="badge">0</span>
                            </a>

                        </li>
                        <li class="button"><a href="/admin/register">Register</a></li>

                    </ul>
                </div>
                <!-- End Atribute Navigation -->

            </div>

            <!-- Main Nav -->
        </div>
        <!-- Overlay screen for menu -->
        <div class="overlay-screen"></div>
        <!-- End Overlay screen for menu -->

    </nav>
    <!-- End Navigation -->
</header>
<!-- End Header -->
