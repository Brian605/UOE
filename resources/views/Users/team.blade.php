@extends('Admin.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded m-2">
        <div class="block-header">
            <h4 class="block-title fw-bold">
                Manage Team Details
            </h4>
            <button class="btn btn-primary block-options" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">New Team Details</button>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Avatar</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Description</th>
                    <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $c=1; @endphp
              @foreach(\App\Models\UserDetails::all() as $team)
                  <tr>
                      <td>
                          {{$c}}
                      </td>
                      <td>
                          {{\App\Models\User::find($team->user_id)->name}}
                      </td>
                      <td>
                         <img src="{{\App\Models\User::find($team->user_id)->avatar==null?'':\App\Models\User::find($team->user_id)->avatar}}" class="img-avatar img-avatar48 rounded" alt="">
                      </td>
                      <td>
                          {!! $team->description !!}
                      </td>
                      <td>
                          <button type="button" onclick="edit('{{base64_encode($team->toJson())}}')" class="btn btn-sm btn-warning">Edit</button>
                          <a href="/users/delete/{{$team->id}}" class="btn btn-sm btn-danger m-2">Delete</a>

                      </td>
                  </tr>
                  @php $c++; @endphp
              @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="editDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Team Member</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/team/edit">
                        @csrf
                        <input type="hidden" id="userId" name="userId">

                        <div class="mb-4">
                            <label class="form-label">Profile Description</label>
                            <textarea id="js-ckeditor2" name="ckeditor"></textarea>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Team</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/team/new">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">User</label>
                            <select name="userId" class="form-control form-select" required>
                                @php
                                    $f=true;
                                @endphp
                                @foreach(\App\Models\User::all() as $user)
                                    @if($f)
                                        <option selected value="{{$user->id}}">{{$user->name}}</option>
                                        @php $f=false; @endphp
                                    @else
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                @endforeach

                            </select>
                         </div>
                        <div class="mb-4">
                            <label class="form-label">Profile Description</label>
                            <textarea id="js-ckeditor" name="ckeditor"></textarea>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
    @vite(['resources/js/pages/datatables.js'])
    <script></script>
    <script>
        function edit(dptJ) {
          let dpt=JSON.parse(atob(dptJ));
            $("#userId").val(dpt.id);
            CKEDITOR.instances["js-ckeditor2"].setData(dpt.description);
            $("#editDepartment").modal('show')
        }
        $(()=>{
            Dashmix.helpersOnLoad(['js-ckeditor','js-ckeditor2']);
        });
    </script>
@endpush
