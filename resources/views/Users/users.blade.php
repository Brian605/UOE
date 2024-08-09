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
                Manage Users
            </h4>
            <button class="btn btn-primary block-options" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">New User</button>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Phone Number</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Roles</th>
                    <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $c=1; @endphp
              @foreach(\App\Models\User::all() as $dept)
                  <tr>
                      <td>
                          {{$c}}
                      </td>
                      <td>
                          <img src="{{$dept->avatar==null?'':$dept->avatar}}" class="img-avatar img-avatar48 rounded" alt="">
                      </td>
                      <td>
                          {{$dept->name}}
                      </td>

                      <td>
                          {{$dept->email}}
                      </td>
                      @if(\App\Models\UserDetails::where('user_id',$dept->id)->exists())
                      <td>
                          {{\App\Models\UserDetails::where('user_id',$dept->id)->first()->phone}}
                      </td>
                      @else
                          <td>N/A</td>
                      @endif
                      <td>
                          {{$dept->roles->count()>0?$dept->roles[0]->name:'N/A'}}
                      </td>
                      <td>
                          @if(!$dept->hasRole('Super Admin'))
                          <button type="button" onclick="edit('{{base64_encode($dept->toJson())}}')" class="btn btn-sm btn-warning">Edit</button>
                          <a href="/users/delete/{{$dept->id}}" class="btn btn-sm btn-danger m-2">Delete</a>
                          @endif
                      </td>
                  </tr>
                  @php $c++; @endphp
              @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <div class="modal fade" id="newDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New User</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/users/new">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" placeholder="e.g Finance,Research etc" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">User Role</label>
                            <select name="role" class="form-control form-select" required>
                                @php $f=true; @endphp
                                @foreach(\Spatie\Permission\Models\Role::where('name','!=','Super Admin')->get() as $role)
                                    @if($f)
                                        <option selected value="{{$role->name}}">{{$role->name}}</option>
                                        @php $f=false; @endphp
                                    @else
                                        <option  value="{{$role->name}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/users/edit">
                        @csrf
                        <input type="hidden" name="id" id="dptid">
                        <div class="mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" id="name" name="name" placeholder="e.g Finance,Research etc" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">User Role</label>
                            <select name="role" id="role" class="form-control form-select" required>
                                @php $f=true; @endphp
                                @foreach(\Spatie\Permission\Models\Role::where('name','!=','Super Admin')->get() as $role)
                                    @if($f)
                                        <option selected value="{{$role->name}}">{{$role->name}}</option>
                                        @php $f=false; @endphp
                                    @else
                                        <option  value="{{$role->name}}">{{$role->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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
    @vite(['resources/js/pages/datatables.js'])
    <script>
        function edit(dptJ) {
          let dpt=JSON.parse(atob(dptJ));
            $("#dptid").val(dpt.id);
            $("#name").val(dpt.name);
            $("#email").val(dpt.email);

            let rolesSelect=document.getElementById('role').children;
            for (let roleNode of rolesSelect){
                if (roleNode.value===dpt.roles[0].name){
                    roleNode.selected=true;
                }
            }
            $("#editDepartment").modal('show')
        }
    </script>
@endpush
