@extends('Admin.backend')
@section('content')
<div class="content">
          <!-- Advanced Gallery -->
          <h2 class="content-heading">Downloads</h2>
          <div class="text-end mb-4">
              <button class="block-options btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newDepartment">Add Files</button>

          </div>
          <div class="row items-push">
              @php $galleries=\App\Models\Download::paginate(12); @endphp
              @foreach($galleries as $gallery)
                  <div class="col-sm-6 col-md-4 col-xl-3 d-flex flex-column">
                      <!-- Example File -->
                      <div class="options-container w-100 flex-grow-1 rounded bg-white d-flex align-items-center">
                          <!-- Example File Block -->
                          <div class="options-item block block-rounded block-transparent mb-0 w-100">
                              <div class="block-content text-center">
                                  <p class="mb-2 overflow-hidden">
                                      <i class="fa fa-fw fa-4x fa-file-alt text-muted"></i>
                                  </p>
                                  <p class="fw-semibold text-break mb-0">
                                      {{$gallery->name}}
                                  </p>

                              </div>
                          </div>
                          <!-- END Example File Block -->

                          <!-- Example File Hover Options -->
                          <div class="options-overlay rounded bg-primary-dark-op">
                              <div class="options-overlay-content">
                                  <div class="mb-3">
                                      <a class="btn btn-primary" href="{{\Illuminate\Support\Facades\Storage::url($gallery->file)}}">
                                          <i class="fa fa-eye opacity-50 me-1"></i> View
                                      </a>
                                  </div>
                                  <div class="btn-group">
                                      <a class="btn btn-sm btn-info" download href="{{\Illuminate\Support\Facades\Storage::url($gallery->file,$gallery->name)}}">
                                          <i class="fa fa-download me-1"></i>
                                      </a>
                                      <a class="btn btn-sm btn-primary" href="/downloads/delete/{{$gallery->id}}">
                                          <i class="fa fa-trash me-1"></i>
                                      </a>
                                  </div>
                              </div>
                          </div>
                          <!-- END Example File Hover Options -->
                      </div>
                      <!-- END Example File -->
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
                    New File
                </h4>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/downloads/new" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">
                            Caption <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">
                            File <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="image" class="form-control" required>
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


