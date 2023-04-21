@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title "> Unassign Asset| <a href="{{url('asset-list')}}"  > <i class="fas fa-arrow-alt-circle-left"></i>Assets</a></h4>
             </div>
            <div class="card-body">
                <form action="{{ url('assetUnassign/'.$assets->id) }}" method="post" enctype="multipart/form-data"
                class="form-horizontal">
                @csrf
                <div class="row py-1">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Asset</label>
                            <input type="text" id="name" name="name" placeholder="Name"  class="form-control" value="{{ $assets->name }}" >        
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Status</label>
                            <select name="status" id="SelectLm" class="form-control">
                                <option value={{$assets->status}}>{{$assets->status}}</option> 
                                    <option value="used">Used</option>
                                    <option value="repaired">Repaired</option>
                                    <option value="broken">Broken</option>
                            </select>
                        </div>
                    </div>
                </div>
              
                <div class="row py-1">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Reason</label>
                            <textarea id="basicpill-address-input" name="reason" class="form-control" rows="2" placeholder="Enter your Reason........."></textarea>
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
