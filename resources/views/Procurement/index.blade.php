@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Procurement</h3>
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
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($procurements as $index => $procurement)
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
                            {{ $procurement->type }}
                        </td>
                        <td>
                            {{ $procurement->paymeny_mode }}
                        </td>
                        <td>
                            {{ $procurement->transaction_id }}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
