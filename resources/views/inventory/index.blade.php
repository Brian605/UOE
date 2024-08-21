@extends('Admin.backend')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@php
$units = \App\Models\Units::all();
$categories = \App\Models\ItemCategory::all();
 @endphp
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Inventory</h3>
        </div>
        <div class="block-content block-content-full">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInventory">
                    Add Inventory
                </button>

            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Approved By</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Inventory::all() as $index => $inventory)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $inventory->name }}
                        </td>
                        <td>
                            {{ $inventory->quantity }}
                        </td>
                        <td>
                            {{ $inventory->unit->unit }}
                        </td>
                        <td>
                            {{ $inventory->user->name }}
                        </td>
                        <td class="d-flex gap-4">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editInventory" onclick="edit({{ $inventory }})">
                                    Edit
                                </button>
{{--                                Add Quantity--}}
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#alterQuantity" onclick="alterQuantity({{ $inventory }},
                                        'increase')">
                                    Add Quantity
                                </button>
{{--                                remove Quantity--}}
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#alterQuantity" onclick="alterQuantity({{ $inventory }},
                                        'decrease')">
                                    Remove Quantity
                                </button>
                                <div>
                                    <form id="deleteForm{{$inventory->id}}"
                                          action="/inventory/list/delete/{{ $inventory->id }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('deleteForm',
                                    {{ $inventory->id }})">Delete
                                        </button>
                                    </form>
                                </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createInventory" tabindex="-1" aria-labelledby="createInventoryLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createInventoryLabel">Add Inventory</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/inventory/list/new" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="unit_id" class="form-label">Unit</label>
                                <select class="form-control" id="unit_id" name="unit_id">
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" id="category_id" name="unit_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
        <div class="modal fade" id="editInventory" tabindex="-1" aria-labelledby="editInventoryLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editInventoryLabel">Edit Inventory</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="edit_quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="edit_unit_id" class="form-label">Unit</label>
                                <select class="form-control" id="edit_unit_id" name="unit_id">
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-control" id="category_id" name="unit_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="alterQuantity" tabindex="-1" aria-labelledby="alterQuantityLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="alterQuantityLabel">Edit Inventory</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editQuantityForm" method="POST">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="type" id="alterQuantityType" value="">
                            <div class="mb-3">
                                <label for="edit_quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function edit(inventory) {
            document.getElementById('edit_name').value = inventory.name;
            document.getElementById('edit_quantity').value = inventory.quantity;
            document.getElementById('edit_unit_id').value = inventory.unit_id;
            document.getElementById('editForm').action = '/inventory/list/' + inventory.id;
        }

        function alterQuantity(inventory, type) {
            document.getElementById('edit_quantity').value = inventory.quantity;
            document.getElementById('alterQuantityType').value = type;
            document.getElementById('editQuantityForm').action = '/inventory/list/' + inventory.id;
        }

    </script>
@endsection
