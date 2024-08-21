@extends('Admin.backend')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Blog Posts</h3>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-primary block-options" href="/blogs/new">
                Add Blog Post
            </a>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date Posted</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @php
                    $causes=\App\Models\Blog::all();
                @endphp
                @foreach($causes as $cause)
                    <tr id="{{$cause->id}}">
                        <td>
                            {{$cause->id}}
                        </td>
                        <td>
                            {{date('d/m/Y',strtotime($cause->created_at))}}
                        </td>
                        <td>
                            {{$cause->title}}
                        </td>
                        <td>
                            {{$cause->description}}
                        </td>
                        <td>
                            {{$cause->cause}}
                        </td>
                        <td>
                            {{implode(',',$cause->tags)}}
                        </td>



                        <td>
                            <a href="/blogs/details/{{$cause->id}}" class="btn btn-sm btn-info"><span class="fa fa-eye"></span> View </a>
                            <a href="/blogs/edit/{{$cause->id}}" class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</a>
                            <a href="/blogs/delete/{{$cause->id}}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> Delete</a>

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
