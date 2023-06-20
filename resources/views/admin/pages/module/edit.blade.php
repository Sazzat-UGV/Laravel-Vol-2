@extends('layouts.master')
@section('title')
Module Edit
@endsection

@push('admin_style')

@endpush
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Module Create Form</h5>
                <small class="text-muted float-end"><a href="{{ route('module.index') }}" class="btn btn-secondary"><i class='bx bx-left-arrow-alt'></i> Back to Module List</a></small>
            </div>
            <div class="card-body">
                <form action="{{ route('module.update',$module->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Module Name</label>
                        <input type="text" name="module_name" value="{{ $module->module_name }}" class="form-control @error('module_name')
                        is-invalid
                        @enderror" id="basic-default-fullname" placeholder="enter module name">
                        @error('module_name')
                          <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                          @enderror
                    </div>

                    <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin_script')

@endpush
