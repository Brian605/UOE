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
                Manage Expenditures
            </h4>
            <button class="btn btn-primary block-options" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">New Expense</button>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Date</th>
                    <th>Category</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Item</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Cost</th>
                    <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $c=1; @endphp
              @foreach(\App\Models\FinanceRecord::all() as $dept)
                  <tr>
                      <td>
                          {{$c}}
                      </td>
                      <td>
                          {{$dept->date->format('d/m/Y')}}
                      </td>
                      <td>
                          {{\App\Models\ItemCategory::find($dept->category_id)->name}}
                      </td>
                      <td>
                          {{$dept->item}}
                      </td>
                      <td>
                         Ksh.{{$dept->cost}}
                      </td>
                      <td>
                          <button type="button" onclick="edit('{{$dept->toJson()}}')" class="btn btn-sm btn-warning">Edit</button>
                          <a href="/expense/item/delete/{{$dept->id}}" class="btn btn-sm btn-danger m-2">Delete</a>

                      </td>
                  </tr>
                  @php $c++; @endphp
              @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="newDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Expense</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/expense/item/new">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <select type="text" name="category" class="form-control form-select" required>
                                @php $category=\App\Models\ItemCategory::all(); $f=true; @endphp
                                @foreach($category as $c)
                                    @if($f)
                                        <option selected value="{{$c->id}}">{{$c->name}}</option>
                                        @php $c=false; @endphp
                                    @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Item</label>
                            <input type="text" name="item" placeholder="e.g Machinery" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Date of Transaction</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Cost</label>
                            <input type="number" step="0.00001" name="cost" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Reason</label>
                            <textarea name="reason" class="form-control"></textarea>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Expense</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/expense/item/edit">
                        @csrf
                        <input type="hidden" name="id" id="dptId">
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <select type="text" name="category" id="category" class="form-control form-select" required>
                                @php $category=\App\Models\ItemCategory::all(); $f=true; @endphp
                                @foreach($category as $c)
                                    @if($f)
                                        <option selected value="{{$c->id}}">{{$c->name}}</option>
                                        @php $c=false; @endphp
                                    @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Item</label>
                            <input type="text" id="item" name="item" placeholder="e.g Machinery" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Date of Transaction</label>
                            <input type="date" id="tdat" name="date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Cost</label>
                            <input type="number" id="cost" step="0.00001" name="cost" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Reason</label>
                            <textarea id="reason" name="reason" class="form-control"></textarea>
                        </div>
                        <div class="mb-4 text-end">
                            <button class="btn btn-primary">Save</button>
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
          let dt=new Date(dpt.date);
          let date=dt.getDate()
          if (date<10){
              date='0'+date
          }else {
              date=date.toString();
          }
            let month=dt.getMonth()+1;
            if (month<10){
                month='0'+month
            }else {
                month=month.toString();
            }

            let d=`${month}-${date}-${dt.getFullYear()}`;
            $("#dptId").val(dpt.id);
            $("#category").val(dpt.category_id);
            $("#item").val(dpt.item);
            $("#cost").val(dpt.cost);
            document.getElementById('tdat').type='text';
            document.getElementById('tdat').value=d;
            document.getElementById('tdat').type='date';
            $("#reason").val(dpt.reason);
            $("#editDepartment").modal('show')
        }
    </script>
@endpush
