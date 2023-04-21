@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title "> Change Password| <a href="{{url('user-list')}}"  > <i class="fas fa-arrow-alt-circle-left"></i>Users</a></h4>
             </div>
            <div class="card-body">
                <form action="{{ route('update-password') }}" method="post" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Old Password</label>
                            <input type="password" id="name" name="old_password" placeholder="Old Password"  class="form-control" >        
                        </div>
                    </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">New Password</label>
                        <input type="password" id="name" name="new_password" placeholder="New Password"  class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Confirm Password</label>
                        <input type="password" id="name" name="new_password_confirmation" placeholder="Confirm New Password"  class="form-control">        
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
