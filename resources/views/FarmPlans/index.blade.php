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
    </div>
@endsection
