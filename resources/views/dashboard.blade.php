@extends('layouts.backend')

@section('content')
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Dashboard</h1>
        <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">App</li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <div class="row items-push">
        @foreach($data as $dt)
            <div class="col-md-6 col-xl-4">
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            {{ $dt['name'] }}
                        </h3>
                    </div>
                    <div class="block-content font-size-sm text-muted">
                        <p>
                            {{ $dt['value'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
  </div>
  <!-- END Page Content -->
@endsection
