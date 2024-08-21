@extends('Admin.backend')
@section('content')
<div class="content">
          <!-- Advanced Gallery -->
          <h2 class="content-heading">Gallery</h2>
          <div class="text-end mb-4">
              <button class="block-options btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">Add Images</button>

          </div>
          <div class="row items-push js-gallery">
              @php $galleries=\App\Models\Gallery::paginate(12); @endphp
              @foreach($galleries as $gallery)
                  <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                      <div class="options-container fx-item-zoom-in fx-overlay-zoom-out">
                          <img class="img-fluid options-item" src="{{\Illuminate\Support\Facades\Storage::url($gallery->image)}}" alt="">
                          <div class="options-overlay bg-black-75">
                              <div class="options-overlay-content">
                                  <h3 class="h4 text-white mb-1">{{$gallery->caption}}</h3>
                                  <h4 class="h6 text-white-75 mb-3">More Info</h4>
                                  <a class="btn btn-sm btn-primary img-lightbox" href="{{\Illuminate\Support\Facades\Storage::url($gallery->image)}}">
                                      <i class="fa fa-search-plus opacity-50 me-1"></i> View
                                  </a>
                                  <a class="btn btn-sm btn-danger" href="/gallery/delete/{{$gallery->id}}">
                                      <i class="fa fa-trash opacity-50 me-1"></i> Delete
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>

              @endforeach

          </div>
    <div class="row d-flex justify-content-evenly">
        {{$galleries->links()}}
    </div>
          <!-- END Advanced Gallery -->
        </div>
<div class="modal fade" id="newDepartment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    New Images
                </h4>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/gallery/new" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">
                            Caption
                        </label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            Images <span class="text-danger">*</span>
                        </label>
                        <input type="file" multiple accept="image/*" name="gallery[]" class="form-control" required>
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

@push('extra')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{asset('js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}">
    </script>
    <script>
        $(()=>{
            Dashmix.helpersOnLoad(['jq-magnific-popup']);
        })
    </script>
@endpush

