@extends('Admin.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title fw-bold">Manage Crops</h3>
            <button type="button" class="btn btn-primary block-options" data-bs-toggle="modal" data-bs-target="#createCrop">
                Create Crop
            </button>
        </div>
        <div class="block-content block-content-full">
                <!-- Button trigger modal -->

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
                @php
                    $crops=\App\Models\Crops::all();
                @endphp
                @foreach($crops as $index => $crop)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $crop->name }}
                        </td>
                        <td>
                            {{ \App\Models\CropCategory::find($crop->type)->name }}
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
                        <td class="d-flex gap-4">
                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editCrop" onclick="editForm('{{base64_encode( $crop->toJson() )}}')">Edit
                            </button>
                            <a href="/crops/delete/{{$crop->id}}" class="btn btn-danger">Delete
                            </a>
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
                    <form action="/crops/new" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control"  name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select type="text" class="form-control form-select"  name="type" required>
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\CropCategory::all() as $category)
                                        @if($f)
                                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="planting_date" class="form-label">Planting Date</label>
                                <input type="date" class="form-control" name="planting_date"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label for="harvest_date" class="form-label">Harvest Date</label>
                                <input type="date" class="form-control" name="harvest_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" required>
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
        <div class="modal fade" id="editCrop" tabindex="-1" aria-labelledby="editCropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editCropLabel">Edit Crop</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="post" action="/crops/edit">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="cropId" id="cropId">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select id="edit_type" class="form-control form-select"  name="type" required>
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\CropCategory::all() as $category)
                                        @if($f)
                                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
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
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const editForm = (cropBase64) => {
            let crop=JSON.parse(atob(cropBase64));
            document.getElementById('cropId').value = crop.id
            document.getElementById('edit_name').value = crop.name
            let typeNodes=document.getElementById('edit_type').children
            for (let typeNode of typeNodes){
                if (parseInt(typeNode.value)===parseInt(crop.type)){
                    typeNode.selected=true;
                }
            }
            document.getElementById('edit_planting_date').value = crop.planting_date
            document.getElementById('edit_harvest_date').value = crop.harvest_date
            document.getElementById('edit_quantity').value = crop.quantity
        }
    </script>
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
@endpush
