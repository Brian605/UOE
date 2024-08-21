@extends('Admin.backend')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Procurement</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary block-options" data-bs-toggle="modal"
                    data-bs-target="#createProcurement">
                Add Procurement
            </button>
        </div>
        <div class="block-content block-content-full">

            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Type</th>
                    <th>payment Mode</th>
                    <th>Transaction</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Procurement::all() as $index => $procurement)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $procurement->item }}
                        </td>
                        <td>
                            {{ $procurement->quantity }}
                        </td>
                        <td>
                            {{ $procurement->cost }}
                        </td>
                        <td>
                            {{ \App\Models\ItemCategory::find($procurement->type)->name }}
                        </td>
                        <td>
                            {{ $procurement->payment_mode }}
                        </td>
                        <td>
                            {{ $procurement->transaction_id }}
                        </td>
                        <td>
                            {{ $procurement->date }}
                        </td>
                        <td class="d-flex gap-4">
                               <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#editProcurement" onclick="edit({{ $procurement }})">
                                    Edit
                                </button>
                            <a href="/procurement/delete/{{$procurement->id}}" class="btn btn-danger">Delete
                            </a>


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createProcurement" tabindex="-1" aria-labelledby="createProcurementLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createProcurementLabel">Add Procurement</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/procurement/new" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" class="form-control" id="item" name="item">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="cost" name="cost">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control form-select" id="type" name="type" required>
                                    @foreach(\App\Models\ItemCategory::all() as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment_mode" class="form-label">Payment Mode</label>
                                <input type="text" class="form-control" id="payment_mode" name="payment_mode">
                            </div>
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id">
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
        <div class="modal fade" id="editProcurement" tabindex="-1" aria-labelledby="editProcurementLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editProcurementLabel">Edit Procurement</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="post">
                        <div class="modal-body">
                            @csrf
                            @method("PUT")
                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" class="form-control" id="edit_item" name="item">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="edit_quantity" name="quantity">
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="edit_cost" name="cost">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control form-select" id="edit_type" name="type" required>
                                    @foreach(\App\Models\ItemCategory::all() as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment_mode" class="form-label">Payment Mode</label>
                                <input type="text" class="form-control" id="edit_payment_mode" name="payment_mode">
                            </div>
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control" id="edit_transaction_id" name="transaction_id">
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
        <script>
            function edit(procurement) {
                document.getElementById('edit_item').value = procurement.item;
                document.getElementById('edit_quantity').value = procurement.quantity;
                document.getElementById('edit_cost').value = procurement.cost;
                document.getElementById('edit_type').value = procurement.type;
                document.getElementById('edit_payment_mode').value = procurement.payment_mode;
                document.getElementById('edit_transaction_id').value = procurement.transaction_id;
                document.getElementById('editForm').action = '/procurement/edit/' + procurement.id;
            }
        </script>
@endsection
        @push('scripts')
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
