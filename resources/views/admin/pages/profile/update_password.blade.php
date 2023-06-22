@extends('layouts.master')
@section('title')
Password Update
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Password Update Form</h5>
                <small class="text-muted float-end"><a href="{{ route('home') }}" class="btn btn-secondary"><i class='bx bx-left-arrow-alt'></i> Back to Dashboard</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('postupdate.Password') }}" method="POST" >
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="old_password">Old Password</label>
                        <input type="password" name="old_password" class="form-control @error('old_password')
                        is-invalid
                        @enderror" id="old_password" placeholder="enter user old password">
                        @error('old_password')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">New Password</label>
                        <input type="password" name="password" class="form-control @error('password')
                        is-invalid
                        @enderror" id="password" placeholder="enter user new password">
                        @error('password')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')
                        is-invalid
                        @enderror" id="password_confirmation" placeholder="retype new password">
                        @error('password_confirmation')
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

@endpush
