@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Crops</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCrop">
                Create Crop
            </button>
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Planting date</th>
                    <th>Harvest Date</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($crops as $index => $crop)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                           {{ $crop->name }}
                        </td>
                        <td>
                            {{ $crop->type }}
                        </td>
                        <td>
                            {{ $crop->planting_date }}
                        </td>
                        <td>
                            {{ $crop->harvest_date }}
                        </td>
                        <td>
                            {{ $crop->quantity }}
                        </td>
                        <td>
                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editCrop" onclick="editForm({{ $crop }})">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createCrop" tabindex="-1" aria-labelledby="createCropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createCropLabel">Add Crop</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('crops.store') }}" method="post">
                    <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>
                            <div class="mb-3">
                                <label for="planting_date" class="form-label">Planting Date</label>
                                <input type="date" class="form-control" id="planting_date" name="planting_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="harvest_date" class="form-label">Harvest Date</label>
                                <input type="date" class="form-control" id="harvest_date" name="harvest_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editCrop" tabindex="-1" aria-labelledby="editCropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editCropLabel">Add Crop</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="post">
                    <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="edit_type" name="type" required>
                            </div>
                            <div class="mb-3">
                                <label for="planting_date" class="form-label">Planting Date</label>
                                <input type="date" class="form-control" id="edit_planting_date" name="planting_date"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="harvest_date" class="form-label">Harvest Date</label>
                                <input type="date" class="form-control" id="edit_harvest_date" name="harvest_date"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const editForm = (crop) => {
            const form = document.getElementById('editForm')
            form.action = `/crops/${crop.id}`
            document.getElementById('edit_name').value = crop.name
            document.getElementById('edit_type').value = crop.type
            document.getElementById('edit_planting_date').value = crop.planting_date
            document.getElementById('edit_harvest_date').value = crop.harvest_date
            document.getElementById('edit_quantity').value = crop.quantity
        }
    </script>
@endsection
