@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light p-3">
                <h4 class="card-title "> Edit Role| <a href="{{url('role-list')}}"  > <i class="fas fa-arrow-alt-circle-left"></i>Roles</a></h4>
             </div>
            <div class="card-body">
                <form action="{{url('role-update/'.$roles->id)}}" method="post" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf

                <div class="row py-1">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Role</label>
                            <input type="text" id="name" name="name" placeholder="Name"  class="form-control" value="{{ $roles->name }}" >        
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Permissions</label>
                            <select name="permission[]" id="SelectLm" class=" js-select2 form-control" multiple="multiple" >
                                <option value="">--Permission--</option>
                                @foreach($permission as $value)
                                <option <?php if (in_array($value->id,$rolePermissions)) { echo "selected"; } ?> 
                                 value="{{ $value->id }}">{{ $value->name }}</option> 
                                @endforeach
                            </select>
                            {{-- <label for="firstnamefloatingInput">Status</label> --}}
                        </div>
                    </div>
                    {{-- <div class="col-md-4" >
                        <div class="mb-3">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">--Staff--</option>
                                <option value="{{ $request->user->id }}" data-badge="">{{ $request->user->name }}</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
              
                <div class="row py-1" style="display: none" id="furniture">
                </div>
                
             
                <div class=" py-2" id="btn" >
                    <button type="submit" class="btn btn-primary btn-sm float-right">
                    <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </form>

            </div>
        </div>
    </div> 
</div> 
@endsection
