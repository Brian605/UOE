@extends('Admin.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Farm plans</h3>
            <button type="button" class="btn btn-primary block-options" data-bs-toggle="modal" data-bs-target="#farmPlans">
                Add Farm Plans
            </button>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Objective</th>
                    <th>Layout</th>
                    <th>Infrastructure</th>
                    <th>Location</th>
                    <th>Farm Size</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $farmPlans=\App\Models\FarmPlans::all(); @endphp
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
                            {{ $plan->location }}
                        </td>
                        <td>
                            {{ $plan->farm_size }}
                        </td>
                        <td class="d-flex gap-4">
                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#editFarmPlans" onclick="edit('{{ base64_encode($plan->toJson()) }}')">Edit
                            </button>
                            <a href="/farm/plans/delete/{{$plan->id}}" class="btn btn-danger">Delete
                            </a>
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
                    <form action="/farm/plans/new" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="objective" class="form-label">Objective</label>
                                <textarea type="text" class="form-control" name="objective"
                                          rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="layout" class="form-label">Layout</label>
                                <input type="text" class="form-control" name="layout">
                            </div>
                            <div class="mb-3">
                                <label for="infrastructure" class="form-label">Infrastructure</label>
                                <input type="text" class="form-control" name="infrastructure">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control"  name="location">
                            </div>
                            <div class="mb-3">
                                <label for="farm_size" class="form-label">Farm Size</label>
                                <input type="text" class="form-control" name="farm_size">
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
        <div class="modal fade" id="editFarmPlans" tabindex="-1" aria-labelledby="editFarmPlansLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editFarmPlansLabel">Edit Farm Plan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="post" action="/farm/plans/edit">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="planId">
                            <div class="mb-3">
                                <label for="objective" class="form-label">Objective</label>
                                <textarea type="text" class="form-control" id="edit_objective" name="objective"
                                          rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="layout" class="form-label">Layout</label>
                                <input type="text" class="form-control" id="edit_layout" name="layout">
                            </div>
                            <div class="mb-3">
                                <label for="infrastructure" class="form-label">Infrastructure</label>
                                <input type="text" class="form-control" id="edit_infrastructure" name="infrastructure">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                            <div class="mb-3">
                                <label for="farm_size" class="form-label">Farm Size</label>
                                <input type="text" class="form-control" id="farm_size" name="farm_size">
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
        const edit = (farmPlanBase64) => {
            let farmPlan=JSON.parse(atob(farmPlanBase64));
            document.getElementById('planId').value=farmPlan.id;
            document.getElementById('farm_size').value=farmPlan.farm_size
            document.getElementById('edit_objective').value = farmPlan.objective;
            document.getElementById('edit_layout').value = farmPlan.layout;
            document.getElementById('location').value = farmPlan.location;
            document.getElementById('edit_infrastructure').value = farmPlan.infrastructure;
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
