@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('{{asset("media/photos/slider-bg.jpg")}}');">
        <div class="row g-0 bg-primary-op">
            <!-- Main Section -->
            <div class="hero-static col-md-6 d-flex align-items-center bg-body-extra-light">
                <div class="p-3 w-100">
                    <!-- Header -->
                    <div class="w-100 text-center">
                        <img class="rounded-circle img-avatar img-avatar128"
                             src="{{asset('media/favicons/favicon.jpg')}}">

                    </div>

                    <div class="mb-3 text-center">
                        <a class="link-fx fw-bold fs-1" href="/">
                             <span
                                 class="text-dark">UOE </span><span class="text-primary"></span>
                        </a>
                        <p class="text-uppercase fw-bold fs-sm text-muted">Sign In</p>
                    </div>
                    <!-- END Header -->

                    <div class="row g-0 justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <form class="js-validation-signin" action="/login" method="POST">
                                @csrf
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt"
                                               id="login-username" required name="username" placeholder="Username">
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt"
                                               required id="login-password" name="password" placeholder="Password">
                                    </div>
                                    <div class="mb-4">
                                        <button class="btn btn-primary form-control">Login</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- END Sign In Form -->
                </div>
            </div>
            <!-- END Main Section -->

            <!-- Meta Info Section -->
            <div
                class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                <div class="p-3">
                    <p class="display-4 fw-bold text-white mb-3">
                        UOE
                    </p>
                    <p class="fs-lg fw-semibold text-white-75 mb-0">
                        Copyright &copy; UOE <span data-toggle="year-copy"></span>
                    </p>
                </div>
            </div>
            <!-- END Meta Info Section -->
        </div>
    </div>
    <!-- END Page Content -->
    @if(isset($message))
        <script>
            Swal.fire(
                "{{$title}}",
                "{{$message}}",
                "{{$type}}"
            )
        </script>
    @endif
@endsection
