@extends('layouts.master')
@section('title')
    User Create
@endsection

@push('admin_style')
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Create Form</h5>
                    <small class="text-muted float-end"><a href="{{ route('user.index') }}" class="btn btn-secondary"><i class='bx bx-left-arrow-alt'></i> Back to User List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Role Selection</label>
                            <select id="defaultSelect" name="role_id" class="form-select @error('role_id')
                            is-invalid
                            @enderror">
                            <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                              </select>
                              @error('role_id')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">User Name</label>
                            <input type="text" name="name" class="form-control @error('name')
                            is-invalid
                            @enderror" id="basic-default-fullname" placeholder="enter user name">
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">User Email</label>
                            <input type="email" name="email" class="form-control @error('email')
                            is-invalid
                            @enderror" id="basic-default-fullname" placeholder="enter user email">
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">User Password</label>
                            <input type="password" name="password" class="form-control @error('password')
                            is-invalid
                            @enderror" id="basic-default-fullname" placeholder="enter user password">
                            @error('password')
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
