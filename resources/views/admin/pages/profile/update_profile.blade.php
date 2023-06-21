@extends('layouts.master')
@section('title')
Profile Update
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Profile Update Form</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-secondary"><i class='bx bx-left-arrow-alt'></i> Back to Dashboard</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('postupdate.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">User Profile Upload</label>
                        <input type="file" data-default-file="{{ asset('uploads/profile_images') }}/{{ $auth_user->user_image }}" class="dropify @error('user_image')
                        is-invalid
                        @enderror" name="user_image">@error('user_image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">User Name</label>
                        <input type="text" value="{{ $auth_user->name }}" name="name" class="form-control @error('name')
                        is-invalid
                        @enderror" id="basic-default-fullname" placeholder="enter user name">
                        @error('name')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Email Name</label>
                        <input type="email" name="email"  value="{{ $auth_user->email }}"class="form-control @error('email')
                        is-invalid
                        @enderror" id="basic-default-fullname" placeholder="enter user email">
                        @error('email')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
