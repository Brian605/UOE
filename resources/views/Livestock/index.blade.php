@extends('Admin.backend')
@section('css')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection
@section('content')
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Manage Livestock</h3>
            <button type="button" class="btn btn-primary block-options" data-bs-toggle="modal" data-bs-target="#createLivestock">
                Add Livestock
            </button>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">#</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Breed</th>
                    <th>Birth date</th>
                    <th>Weight</th>
                    <th>Health Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $livestocks=\App\Models\Livestock::all(); @endphp
                @foreach($livestocks as $index => $livestock)
                    <tr>
                        <td class="text-center">{{ $index+1 }}</td>
                        <td class="fw-semibold">
                            {{ \App\Models\LivestockTypes::find($livestock->type)->name}}
                        </td>
                        <td>
                            {{\App\Models\LivestockCategory::find($livestock->category)->name}}
                        </td>
                        <td>
                            {{\App\Models\LivestockBreed::find($livestock->breed)->name}}
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
                        <td class="d-flex gap-4">
                            <button type="button" class="btn btn-secondary"
                                    onclick="edit('{{base64_encode($livestock->toJson())}}')">
                                Edit
                            </button>
                            <a href="/livestock/delete/{{$livestock->id}}" class="btn btn-danger">Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createLivestock" tabindex="-1" aria-labelledby="createLivestockLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createLivestockLabel">New Livestock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/livestock/new" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select type="text" class="form-control form-select"  name="type">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockTypes::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Category</label>
                                <select type="text" class="form-control form-select"  name="category">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockCategory::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Breed</label>
                                <select type="text" class="form-control form-select"  name="breed">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockBreed::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date">
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="number" class="form-control" name="weight">
                            </div>
                            <div class="mb-3">
                                <label for="health_status" class="form-label">Health Status</label>
                                <input type="text" class="form-control" name="health_status">
                            </div>
                            <div class="mb-3">
                                <label for="milk_produce" class="form-label">Milk Produce</label>
                                <input type="text" class="form-control" name="milk_produce">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editLives">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Livestock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('livestock.edit')}}" method="post">
                            @csrf
                            <input type="hidden" id="livestockId" name="livestockId">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select type="text" class="form-control form-select" id="type" name="type">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockTypes::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="category"  name="category">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockCategory::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="breed" class="form-label">Breed</label>
                                <select class="form-control form-select" id="breed" name="breed">
                                    @php $f=true; @endphp
                                    @foreach(\App\Models\LivestockBreed::all() as $type)
                                        @if($f)
                                            <option selected value="{{$type->id}}">{{$type->name}}</option>
                                            @php $f=false; @endphp
                                        @else
                                            <option  value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="edit_birth_date" name="birth_date">
                            </div>
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="number" class="form-control" id="edit_weight" name="weight">
                            </div>
                            <div class="mb-3">
                                <label for="health_status" class="form-label">Health Status</label>
                                <input type="text" class="form-control" id="edit_health_status" name="health_status">
                            </div>

                            <div class="mb-3">
                                <label for="edit_milk_produce" class="form-label">Milk Produce</label>
                                <input type="text" class="form-control" id="edit_milk_produce" name="edit_milk_produce">
                            </div>
                            <div class="justify-content-evenly">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function edit(livestockBase64) {
            let livestock=JSON.parse(atob(livestockBase64));
           let types=document.getElementById('type').children;
            for (let type of types) {
                if (type.value==livestock.type){
                    type.selected=true;
                }
            }
            $("#livestockId").val(livestock.id);
            document.getElementById('category').value = livestock.category;
            document.getElementById('breed').value = livestock.breed;
            document.getElementById('edit_birth_date').value = livestock.birth_date;
            document.getElementById('edit_weight').value = livestock.weight;
            document.getElementById('edit_health_status').value = livestock.health_status;
            document.getElementById('edit_milk_produce').value = livestock.milk_produce;
            $("#editLives").modal('show')
        }

    </script>
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

@endpush
