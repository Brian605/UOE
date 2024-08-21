@extends('Admin.backend')
@section('title')
    New Blog Post
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.6/filepond.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.css">
@endsection


@section('content')
    <div class="block block-rounded m-2">

        <div class="block-content block-content-full">
            <form method="post" action="/blogs/edit/{{$blog->id}}" class="m-2">
                @csrf
                <div class="row d-flex justify-content-evenly">
                    <div class="mb-4 col-md-5">
                        <label for="title" class="form-label">
                            Post Title
                        </label>
                        <input class="form-control" value="{{$blog->title}}" name="title" id="title" type="text" maxlength="255" required>
                    </div>
                    <div class="mb-4 col-md-5">
                        <label for="title" class="form-label">
                            Short Description
                        </label>
                        <textarea class="form-control" name="description" id="description" type="text"  required>{{$blog->description}}</textarea>
                    </div>
                    <div class="mb-4 col-md-2">

                        @php
                            $categories=\App\Models\ResearchCategory::all();
                            $first=true;
                        @endphp
                        <label class="form-label" for="category">Blog Category</label>
                        <select required id="category"  class="form-control form-select" name="category">
                            @foreach($categories as $category)
                                <option @selected($blog->cause==$category->name) value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Manage Tags</label>
                        <textarea name="tags" class="form-control" required>{{implode(',',$blog->tags)}}</textarea>
                        <small>You can type in multiple tags separated by comma</small>
                    </div>
                    <div class="mb-4 col-md-6">
                        <label class="form-label" for="attachments">Banner Image</label>
                        <input  id="attachments" type="file" class="attachment" name="filepond" data-max-file-size="10MB" data-max-files="1">
                    </div>
                    <div class="mb-4 col-md-12">
                        <label class="form-label">Content</label>
                        <textarea id="js-ckeditor" name="blog" class="row d-flex justify-content-evenly">{!! $blog->content !!}</textarea>

                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger">
                            Save Post
                        </button>
                    </div>

                </div>

            </form>
        </div>

    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/filepond/4.30.6/filepond.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.6.12/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-exif-orientation@1.0.11/dist/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-size@2.2.8/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-encode@2.1.14/dist/filepond-plugin-file-encode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1.2.9/dist/filepond-plugin-file-validate-type.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-resize@2.0.10/dist/filepond-plugin-image-resize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-transform@3.8.7/dist/filepond-plugin-image-transform.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-edit@1.6.3/dist/filepond-plugin-image-edit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-crop@2.0.6/dist/filepond-plugin-image-crop.min.js"></script>
    <script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        (function (){
            /* filepond */
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginFileEncode,
                FilePondPluginImageEdit,
                FilePondPluginFileValidateType,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform
            );

            const MultipleElement = document.querySelector('.attachment');

            FilePond.create(MultipleElement,{
                allowMultiple: false,
                allowImagePreview: true,
                allowImageFilter: true,
                imagePreviewHeight: 100,
                allowRevert: true,
                maxFiles: 1,
                name:'filepond',
                server: {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: "/system/files/add",
                    process: true,
                    restore: "system/files/delete",
                    fetch: false,
                },
            });

        })();

       $(()=>{
           Dashmix.helpersOnLoad(['js-ckeditor'])
       })

    </script>

@endpush
