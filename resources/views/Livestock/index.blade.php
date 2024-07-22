@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Livestock's</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLivestock">
                Add Livestock
            </button>
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Birth date</th>
                    <th>Weight</th>
                    <th>Health Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($livestocks as $index => $livestock)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $livestock->type }}
                        </td>
                        <td>
                            {{ $livestock->breed }}
                        </td>
                        <td>
                            {{ $livestock->birth_date }}
                        </td>
                        <td>
                            {{ $livestock->weight }}
                        </td>
                        <td>
                            {{ $livestock->health_status }}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createLivestock" tabindex="-1" aria-labelledby="createLivestockLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createLivestockLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('livestocks.store') }}" method="POST">
                    <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type">
                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Breed</label>
                                <input type="text" class="form-control" id="breed" name="breed">
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date">
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="text" class="form-control" id="weight" name="weight">
                            </div>
                            <div class="mb-3">
                                <label for="health_status" class="form-label">Health Status</label>
                                <input type="text" class="form-control" id="health_status" name="health_status">
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
@endsection
