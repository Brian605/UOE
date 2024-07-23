@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Roles</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRole">
                Add Role
            </button>
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $index => $role)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $role->name }}
                        </td>
                        <td>
                            {{ $role->guard_name }}
                        </td>
                        <td class="d-flex gap-4">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editRole" onclick="edit({{ $role }})">
                                Edit
                            </button>
                            <div>
                                <form id="deleteForm{{$role->id}}" action="{{ route('roles.destroy', $role->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="confirmDelete
                                      ('deleteForm', {{ $role->id }})">Delete</button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createRole" tabindex="-1" aria-labelledby="createRoleLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createRoleLabel">Roles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('roles.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="department" class="form-label">name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions</label>
                                <select class="form-select" id="permissions" name="permissions" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editRole" tabindex="-1" aria-labelledby="editRoleLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editRoleLabel">Roles</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method("PUT")
                            <div class="mb-3">
                                <label for="department" class="form-label">name</label>
                                <input type="text" class="form-control" id="edit_name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions</label>
                                <select class="form-select" id="edit_permissions" name="permissions" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const edit = (role) => {
            document.getElementById('edit_name').value = role.name;
            document.getElementById('edit_permissions').value = role.permissions;
            document.getElementById("editForm").action = `roles/${role.id}`;
        }
    </script>
@endsection
