@extends('Admin.auth')
@section('content')
        <div class="bg-image" style="background-image: url('https://www.uoeld.ac.ke/sites/default/files/updates_gallery/2023-10/abtf-2023-d1-4_0.JPG');">
          <div class="row g-0 bg-gd-sun-op">
            <!-- Main Section -->
            <div class="hero-static col-md-6 d-flex align-items-center bg-body-extra-light">
              <div class="p-3 w-100">
                <!-- Header -->
                <div class="text-center">
                    <img class="rounded"
                         src="{{asset('https://www.uoeld.ac.ke/themes/uoeld/logo.png')}}">
                  <p class="text-uppercase fw-bold fs-sm text-muted">Password Reminder</p>
                </div>
                <!-- END Header -->

                <div class="row g-0 justify-content-center">
                  <div class="col-sm-8 col-xl-6">
                    <form class="js-validation-reminder" action="/password/request" method="POST">
                        @csrf
                      <div class="py-3 mb-4">
                        <input type="text" class="form-control form-control-lg form-control-alt" id="reminder-credential" name="email" placeholder="Registered Email">
                      </div>
                      <div class="text-center mb-4">
                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary">
                          <i class="fa fa-fw fa-reply opacity-50 me-1"></i> Get a Password Reset Link
                        </button>
                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                          <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="/login">
                            <i class="fa fa-sign-in-alt opacity-50 me-1"></i> Sign In
                          </a>
                          <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="/register">
                            <i class="fa fa-plus opacity-50 me-1"></i> New Account
                          </a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- END Reminder Form -->
              </div>
            </div>
            <!-- END Main Section -->

            <!-- Meta Info Section -->
            <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
              <div class="p-3">
                <p class="display-4 fw-bold text-white mb-0">
                    UOE Farm Management System
                </p>
                <p class="fs-1 fw-semibold text-white-75 mb-0">
                    Bringing to life your dream farm.
                </p>
              </div>
            </div>
            <!-- END Meta Info Section -->
          </div>
        </div>
        <!-- END Page Content -->
@endsection
