@extends('layouts.master')
@section('title')
    Page Edit
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            #container {
                width: 1000px;
                margin: 20px auto;
            }
            .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
            .ck-content .image {
                /* block images */
                max-width: 80%;
                margin: 20px auto;
            }
        </style>
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Page Edit Form</h5>
                    <small class="text-muted float-end"><a href="{{ route('page.index') }}" class="btn btn-secondary"><i
                                class='bx bx-left-arrow-alt'></i> Back to Page List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('page.update',$page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="short_description">Page Short Description</label>
                                        <textarea name="short_description" class="form-control @error('short_description')
                                        is-invalid
                                        @enderror" id="short_description" cols="30" rows="7">{{ $page->short_description }}</textarea>
                                        @error('short_description')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="long_description">Page Long Description</label>
                                        <textarea name="long_description" class="form-control @error('long_description')
                                        is-invalid
                                        @enderror" id="long_description" cols="30" rows="7">{{ $page->long_description }}</textarea>
                                        @error('long_description')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label" for="meta_description">Page Meta Description</label>
                                        <textarea name="meta_description" class="form-control @error('meta_description')
                                        is-invalid
                                        @enderror" id="meta_description" cols="30" rows="7">{{ $page->meta_description }}</textarea>
                                        @error('meta_description')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                </div></div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="page_image">Page Image Upload</label>
                                    <input type="file" data-default-file="{{ asset('uploads/page_images') }}/{{ $page->page_image }}"
                                        class="dropify @error('page_image')
                                    is-invalid
                                    @enderror"
                                        name="page_image">
                                    @error('page_image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="title">Page Title</label>
                                            <input type="text" name="title" value="{{ $page->title }}"
                                                class="form-control @error('title')
                                            is-invalid
                                            @enderror"
                                                id="title" placeholder="page title">
                                            @error('title')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label" for="slug">Page Slug <small class="text-danger text-none">(slug value should have '-' example: 'about-us') *</small></label>
                                            <input type="text" name="slug" value="{{ $page->slug }}"
                                                class="form-control @error('slug')
                                                                    is-invalid
                                                                    @enderror"
                                                id="slug" placeholder="page slug">
                                            @error('slug')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_title">Meta title</label>
                                            <input type="text" name="meta_title" value="{{ $page->meta_title }}"
                                                class="form-control @error('meta_title')
                                            is-invalid
                                            @enderror"
                                                id="meta_title" placeholder="meta title">
                                            @error('meta_title')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" value="{{ $page->meta_keywords }}"
                                                class="form-control @error('meta_keywords')
                                                                    is-invalid
                                                                    @enderror"
                                                id="meta_keywords" placeholder="meta keywords">
                                            @error('meta_keywords')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>


    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
                .create( document.querySelector( '#short_description' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
        ClassicEditor
                .create( document.querySelector( '#long_description' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
        ClassicEditor
                .create( document.querySelector( '#meta_description' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
</script>
@endpush
