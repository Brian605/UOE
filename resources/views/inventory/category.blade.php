@extends('Admin.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded m-2">
        <div class="block-header">
            <h4 class="block-title fw-bold">
                Item Categories
            </h4>
            <button class="btn btn-primary block-options" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">New Item Category</button>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Icon</th>
                    <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $c=1; @endphp
              @foreach(\App\Models\ItemCategory::all() as $dept)
                  <tr>
                      <td>
                          {{$c}}
                      </td>
                      <td>
                          {{$dept->name}}
                      </td>
                      <td>
                         <img src="{{$dept->icon==null?'':$dept->icon}}" class="img-avatar img-avatar48 rounded" alt="">
                      </td>
                      <td>
                          <button type="button" onclick="edit('{{$dept->toJson()}}')" class="btn btn-sm btn-warning">Edit</button>
                          <a href="/item/category/delete/{{$dept->id}}" class="btn btn-sm btn-danger m-2">Delete</a>

                      </td>
                  </tr>
                  @php $c++; @endphp
              @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="editDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/item/category/edit">
                        @csrf
                        <input type="hidden" id="dptId" name="dptId">
                        <div class="mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" id="nameEdit" name="name" placeholder="e.g Cash Crop" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Icon Url</label>
                            <input type="url" id="iconEdit" name="icon" class="form-control">
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Item Category</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/item/category/new">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" placeholder="e.g Machinery" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Icon Url</label>
                            <input type="url" name="icon" class="form-control">
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <script>
        function edit(dptJ) {
          let dpt=JSON.parse(dptJ);
            $("#dptId").val(dpt.id);
            $("#nameEdit").val(dpt.name);
            $("#iconEdit").val(dpt.icon);
            $("#editDepartment").modal('show')
        }
    </script>
@endpush
