@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Crops</h3>
        </div>
        <div class="block-content block-content-full">
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
                            {{ $crop->planting_date->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ $crop->harvest_date->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ $crop->quantity }}
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
