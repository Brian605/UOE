@extends('layouts.backend')

@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Farm plans</h3>
        </div>
        <div class="block-content block-content-full">
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
    </div>
@endsection
