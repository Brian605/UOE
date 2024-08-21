@extends('Admin.backend')
@section('content')
    <div class="block block-rounded m-2">
        <div class="block-header">
            <h4 class="block-title fw-bold">
                New Project
            </h4>
        </div>
        <hr class="separator">
        <div class="block-content block-content-full">
         <form method="post" action="/research/new" enctype="multipart/form-data">
             @csrf
             <div class="row d-flex justify-content-evenly">
                 <div class="mb-3 col-md-6">
                     <label for="title" class="form-label">Title</label>
                     <input type="text" class="form-control" id="title" name="title" required>
                 </div>
                 <div class="mb-3 col-md-6">
                     <label for="category" class="form-label">Department</label>
                     <select  class="form-control form-select" id="category" name="category_id" required>
                        @foreach(\App\Models\ResearchCategory::all() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                     </select>
                 </div>

                 <div class="mb-3 col-md-12">
                     <label for="description" class="form-label">Description</label>
                     <textarea class="form-control" id="js-ckeditor" name="description" required></textarea>
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="start_date" class="form-label">Start Date</label>
                     <input type="date" class="form-control" id="start_date" name="start_date" required>
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="end_date" class="form-label">End Date</label>
                     <input type="date" class="form-control" id="end_date" name="end_date" required>
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="banner" class="form-label">Banner Image</label>
                     <input type="file" accept="image/*" class="form-control" id="banner" name="banner" required>
                     <small>Preferred size is 1500x700</small>

                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="sponsors" class="form-label">Sponsors</label>
                     <textarea placeholder="e.g Sp1,Sp2,Sp3" class="form-control" id="sponsors" name="sponsors" required></textarea>
                     <small>You can type in multiple sponsors separated by comma</small>
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="cost" class="form-label">Estimated Cost(Ksh.)</label>
                     <input type="number" step="0.0001"  class="form-control" id="cost" name="cost" required>
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="status" class="form-label">Status</label>
                     <select class="form-select" id="status" name="status">
                         <option selected value="active">Active</option>
                         <option value="inactive">Inactive</option>
                     </select>
                 </div>
                 <div class="mb-4 text-end">
                     <button type="submit" class="btn btn-primary">Add</button>
                 </div>
             </div>
         </form>
        </div>
    </div>


@endsection
@push('scripts')
<script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(()=>{
            Dashmix.helpersOnLoad(['js-ckeditor'])
        })
    </script>


@endpush
