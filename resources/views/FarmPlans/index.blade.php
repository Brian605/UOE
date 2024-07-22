@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Farm plans</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#farmPlans">
                Add Farm Plans
            </button>
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Objective</th>
                    <th>Layout</th>
                    <th>Infrastructure</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($farmPlans as $index => $plan)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $plan->objective }}
                        </td>
                        <td>
                            {{ $plan->layout }}
                        </td>
                        <td>
                            {{ $plan->infrastructure }}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="farmPlans" tabindex="-1" aria-labelledby="farmPlansLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="farmPlansLabel">Add Farm Plan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('farm-plans.store') }}" method="post">
                    <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="objective" class="form-label">Objective</label>
                                <textarea type="text" class="form-control" id="objective" name="objective"
                                          rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="layout" class="form-label">Layout</label>
                                <input type="text" class="form-control" id="layout" name="layout">
                            </div>
                            <div class="mb-3">
                                <label for="infrastructure" class="form-label">Infrastructure</label>
                                <input type="text" class="form-control" id="infrastructure" name="infrastructure">
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
