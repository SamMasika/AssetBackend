@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title ">Edit User| <a href="{{url('user-list')}}"  > <i class="fas fa-arrow-alt-circle-left"></i>Users</a></h4>
             </div>
            <div class="card-body">
                <form action="{{url('user-assignRole/'.$users->id)}}" method="post" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf
                
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">FullName</label>
                            <input type="text" id="name" name="name" placeholder="Name"  class="form-control" value="{{ $users->name }}" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">UserName</label>
                            <input type="text" id="name" name="username" placeholder="Name"  class="form-control" value="{{ $users->username }}" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Email</label>
                            <input type="email" id="name" name="email" placeholder="Name"  class="form-control" value="{{ $users->email }}" >        
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Phone</label>
                            <input type="text" id="name" name="phone" placeholder="Name"  class="form-control" value="{{ $users->phone }}" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Department</label>
                            <input type="text" id="name" name="depart_id" placeholder="Name"  class="form-control" value="{{ $users->department->name }}" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Role</label>
                            <select class="js-select2 form-control" name="role[]" id="rolename" multiple >
                                @foreach($roles as $value)
                                <option <?php if (in_array($value->id,$userRole)) { echo "selected"; } ?> 
                                 value="{{ $value->id }}">{{ $value->name }}</option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
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
