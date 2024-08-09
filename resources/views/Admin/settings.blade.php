@extends('Admin.backend')
@section('content')
    <div class="row d-flex justify-content-evenly">
        <div class="col-md-6">
            <div class="block block-rounded m-2">
                <div class="block-header card-header">
                    <h4 class="block-title fw-bold">
                        Change Password
                    </h4>
                </div>
                <hr class="separator">
                <div class="block-content block-content-full">
                    <form method="post" action="/password/change">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
