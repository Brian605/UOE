@extends('Front.main')
@section('content')
    <!-- Start Breadcrumb
    ============================================= -->
    <div class="breadcrumb-area text-center shadow dark-hard bg-cover text-light" style="background-image: url('{{asset('assets/img/15.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="/"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active">About</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start About
    ============================================= -->
    <div class="about-style-one-area default-padding overflow-hidden">
        <div class="container">
            <div class="row align-center">
                <div class="col-xl-6 col-lg-5">
                    <div class="about-style-one-thumb">
                        <img src="assets/img/800x1000.png" alt="Image Not Found">
                        <div class="animation-shape">
                            <img src="assets/img/illustration/1.png" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6 offset-lg-1">
                    <div class="about-style-one-info">

                        <h2 class="title">Agriculture & Organic <br> Product Farm</h2>
                        <p>
                            There are many variations of passages of ipsum available but the majority have suffered alteration in some form by injected humor or random word which don’t look even. Comparison new ham melancholy.
                        </p>
                        <div class="fun-fact-style-flex mt-35">
                            <div class="counter">
                                <div class="timer" data-to="25" data-speed="2000">25</div>
                                <div class="operator">M</div>
                            </div>
                            <span class="medium">Growth Tonns <br> of Harvest</span>
                        </div>
                        <ul class="top-feature">
                            <li>
                                <div class="icon">
                                    <img src="assets/img/icon/3.png" alt="Image Not Found">
                                </div>
                                <div class="info">
                                    <h4>100% Guaranteed Organic Product</h4>
                                    <p>
                                        Always parties but trying she shewing of moment.
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <img src="assets/img/icon/2.png" alt="Image Not Found">
                                </div>
                                <div class="info">
                                    <h4>Top-Quality Healthy Foods Production</h4>
                                    <p>
                                        Majority have suffered alteration in some form by injected humor.
                                    </p>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

@endsection
