@extends('layouts.master')
@section('title')
    Role Create
@endsection

@push('admin_style')
@endpush
@section('content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Role Create Form</h5>
                    <small class="text-muted float-end"><a href="{{ route('role.index') }}" class="btn btn-secondary"><i class='bx bx-left-arrow-alt'></i> Back to Role List</a></small>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Role Name</label>
                            <input type="text" name="role_name" class="form-control @error('role_name')
                            is-invalid
                            @enderror" id="basic-default-fullname" placeholder="enter module name">
                            @error('role_name')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-rolenote">Role Note</label>
                            <input type="text" name="role_note" class="form-control @error('role_note')
                            is-invalid
                            @enderror" id="basic-default-fullname" placeholder="enter role note">
                            @error('role_note')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                        </div>

                           <div class="mt-4 mb-2">
                            <strong class="@error('permissions')
                            is-invalid
                            @enderror">Manage Permissions for Role</strong>
                            @error('permissions')
                              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                              @enderror
                           </div>

                           <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="select-all">
                            <label class="form-check-label" for="defaultCheck1">Select All</label>
                          </div>

                          <div class="my-5">
                            @foreach ($modules->chunk(2) as $key=>$chunks)
                            <div class="row">
                                @foreach ($chunks as $module)
                                <div class="col mb-4">
                                    <h5 class="text-primary ">Module: {{ $module->module_name }}</h5>

                                    <!--module permissions list -->
                                    @foreach ($module->permissions as $permission)

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->permission_name }}</label>
                                    </div>
                                    @endforeach
                                    <!--module permissions list -->
                                </div>
                                    @endforeach
                            </div>
                            @endforeach
                          </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script>
    //Listen for click on select all checkbox
    $('#select-all').click(function(event){
        if(this.checked){
            //loop each checkbox
            $(':checkbox').each(function(){
                this.checked =true;
            })
        }else{
              //loop each checkbox
              $(':checkbox').each(function(){
                this.checked =false;
            })
        }
    });
</script>
@endpush
