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
                Financial Receipts
            </h4>
            <button class="btn btn-primary block-options" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">New Receipt</button>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Receipt Number</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Date</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Amount</th>
                    <th>Description</th>
                    <th style="width: 15%;">Action</th>
                </tr>
                </thead>
                <tbody>
                @php $c=1; @endphp
              @foreach(\App\Models\Receipt::all() as $dept)
                  <tr>
                      <td>
                          {{$c}}
                      </td>
                      <td>
                          {{$dept->ref_number}}
                      </td>
                      <td>
                          {{$dept->date->format('d/m/Y')}}
                      </td>


                      <td>
                         Ksh.{{$dept->amount}}
                      </td>
                      <td>
                          {{$dept->description}}
                      </td>
                      <td>
                          <button type="button" onclick="edit('{{base64_encode($dept->toJson())}}')" class="btn btn-sm btn-warning">Edit</button>
                          <a href="/receipt/item/delete/{{$dept->id}}" class="btn btn-sm btn-danger m-2">Delete</a>

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
                    <h4 class="modal-title">New Receipt</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/receipt/item/new">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Reference Number</label>
                            <input type="text" class="form-control" name="ref_number">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Amount</label>
                            <input type="number" step="0.00001" name="amount" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Date of Transaction</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description"></textarea>
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
                    <h4 class="modal-title">Edit Receipt</h4>
                    <button class="btn btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/receipt/item/edit">
                        @csrf
                        <input type="hidden" name="id" id="dptId">

                        <div class="mb-4">
                            <label class="form-label">Reference Number</label>
                            <input type="text" id="ref" class="form-control" name="ref_number">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Amount</label>
                            <input type="number" id="amount" step="0.00001" name="amount" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Date of Transaction</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea id="desc" class="form-control" name="description"></textarea>
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
        function edit(dptJBase64) {
          let dpt=JSON.parse(atob(dptJBase64));
          console.log(dpt)
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
            $("#ref").val(dpt.ref_number);
            $("#desc").text(dpt.description);
            $("#amount").val(dpt.amount);
            document.getElementById('date').type='text';
            document.getElementById('date').value=d;
            document.getElementById('date').type='date';
             $("#editDepartment").modal('show')
        }
    </script>
@endpush
