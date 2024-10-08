@extends('Admin.backend')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Research</h3>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary block-options" href="/research/new">
                Add Project
            </a>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Department</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Sponsors</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Research::all() as $index => $research)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ \App\Models\ResearchCategory::find($research->category_id)->name }}
                        </td>
                        <td>
                            {{ $research->title }}
                        </td>
                        <td>
                            {!! substr($research->description,0,60)  !!}...
                        </td>
                        <td>
                            {{ $research->duration }}
                        </td>
                        <td>
                            {{ implode(',',$research->sponsors )}}
                        </td>
                        <td>
                            Ksh.{{$research->cost}}
                        </td>
                        <td>
                            {{ $research->status }}
                        </td>
                        <td class="d-flex gap-4">
                            <a  class="btn btn-info"  href="/research/view/{{$research->id}}">
                                View
                            </a>
                                <a  class="btn btn-secondary"  href="/research/edit/{{$research->id}}">
                                    Edit
                                </a>
                               <a  class="btn btn-danger" href="/research/delete/{{$research->id}}">Delete
                                </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

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
