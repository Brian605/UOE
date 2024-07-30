@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Inventory</h3>
        </div>
        <div class="block-content block-content-full">
            @can('livestocks.create')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInventory">
                    Add Inventory
                </button>
            @endcan

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
                @foreach($inventories as $index => $inventory)
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
                            {{ $inventory->approved_by }}
                        </td>
                        <td class="d-flex gap-4">
                            @can('inventory.edit')
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editInventory" onclick="edit({{ $inventory }})">
                                    Edit
                                </button>
                            @endcan
                            @can('inventory.destroy')
                                <div>
                                    <form id="deleteForm{{$inventory->id}}"
                                          action="{{ route('inventory.destroy', $inventory->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('deleteForm',
                                    {{ $inventory->id }})">Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
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
                    <form action="{{ route('inventory.store') }}" method="POST">
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
        function edit(livestock) {
            document.getElementById('edit_name').value = livestock.name;
            document.getElementById('edit_quantity').value = livestock.quantity;
            document.getElementById('edit_unit_id').value = livestock.unit_id;
            document.getElementById('editForm').action = '/inventory/' + livestock.id;
        }

    </script>
@endsection
