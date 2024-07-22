@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Finances</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Item</th>
                    <th>Cost</th>
                    <th>Date</th>
                    <th>category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($finances as $index => $finance)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ $finance->item }}
                        </td>
                        <td>
                            {{ $finance->cost }}
                        </td>
                        <td>
                            {{ $finance->date }}
                        </td>
                        <td>
                            {{ $finance->category }}
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
