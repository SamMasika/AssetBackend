@extends('layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sections
        </h2>
        
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('dashboard')}}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{url('section-list')}}">Section</a>
            </li>
        </ol>
       
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>
                    <a data-toggle="modal" class="btn btn-primary" href="#showmodal"><i class="fa fa-plus"></i>  Add Section</a>
                </h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                   
                    
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover test-table" >
            <thead>
            <tr>
                <th> Name</th>
                <th> Asset Code</th>
                <th> Request</th>
                <th> Availability</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($assets as $item)
            <tr >
                <td>{{$item->name}}</td>
                <td>{{$item->asset_code}}</td>
                @if($item['flug']==0)
                 <td> <span class="badge rounded-pill badge-soft-primary font-size-12 fw-medium">Available</span></td>
                                            @elseif($item['flug']==1)
                <td> <span class="badge rounded-pill badge-soft-warning font-size-12 fw-medium">Pending</span></td>
                                            @elseif($item['flug']==2)
               <td> <span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">Approved</span></td>
                                            @elseif($item['flug']==3)
                 <td> <span class="badge rounded-pill badge-soft-danger font-size-12 fw-medium">Assigned</span></td>
                                        @endif
                                        @if ($item['user_id'] !=NULL)
                <td><span class="badge rounded-pill badge-soft-warning font-size-12 fw-medium">InUse</span></td>
                                        @else
                <td ><span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">InStore</span></td>
                                        @endif
                <td>{{$item->name}}</td>

                <td class="center">A</td>
            </tr>
          @endforeach
           
            </tfoot>
            </table>
                </div>

            </div>
        </div>
    </div>
    </div>
</div>




            
            
            
   
            
            
            <div class="modal fade" id="showModal"   aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" >Add Asset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ url('asset-store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <div class="row py-1">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Category</label>
                        <select name="category" id="asset_cat" class="form-control">
                            <option value="">--Category--</option>
                            <option value="furniture">Furniture</option>
                            <option value="electronic">Electronic</option>
                            <option value="building">Building</option>
                            <option value="transport">Transport</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Status</label>
                        <select name="status" id="SelectLm" class="form-control">
                            <option value="">--Status--</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                            <option value="repaired">Repaired</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Asset Name</label>
                        <input type="text" id="name" name="name" placeholder="Name"  class="form-control" >        
                    </div>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Purchasing Price</label>
                        <input type="number" id="p_price" name="p_price" placeholder="Purchasing Price" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Useful life</label>
                        <input type="number" id="UTA" name="uta" placeholder="Useful-Life" class="form-control"> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Manufactured Year</label>
                        <input type="year" id="manufactured_year" name="manufactured_year" placeholder="Manufactured_year"
                            class="form-control">       
                    </div>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-md-4" >
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Purchase Date</label>
                        <input type="date" id="purchase_date" name="purchase_date" placeholder="Purchase Date" class="form-control" >        
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="furniture">
                <div class="col-md-12" >
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Furniture Type</label>
                        <select name="furniture_type" id="furniture_type" class="form-control">
                            <option value="">--Furniture_Type--</option>
                            <option value="wood">Wood</option>
                            <option value="plastic">Plastic</option>
                            <option value="iron">Iron</option>
                            <option value="woodiron">Wood And Iron</option>
                            <option value="woodsponge">Wood And Sponge</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="electronics">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Brand</label>
                        <input type="text" id="chapa" name="chapa" placeholder="Brand" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Model</label>
                        <input type="text" id="modeli" name="modeli"  placeholder="Model" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Serial No.</label>
                        <input type="text" id="serial_no" name="serial_no" placeholder="Serial Number" class="form-control" >        
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="building">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Size</label>
                        <input type="number" id="size" name="size" placeholder="Size"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Floors</label>   
                        <input type="number" id="floor_no" name="floor_no" placeholder="Floors"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Rooms</label>
                        <input type="number" id="no_of_rooms" name="no_of_rooms" placeholder="Rooms"
                            class="form-control">       
                    </div>
                </div>
            </div>
            <div class="row py-1" id="buildings" style="display: none">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Purpose</label>
                        <textarea name="purpose" id="purpose" rows="3" maxlength = "40"
                            placeholder="Purpose..." class="form-control"></textarea>       
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="transport">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Transport Type</label>
                        <select name="transport_type" id="transport_type" class="form-control">
                            <option value="">--Transport_Type--</option>
                            <option value="vehicle">Vehicle</option>
                            <option value="bajaj">Bajaj</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Cheses No.</label>
                        <input type="text" id="cheses_no" name="cheses_no" placeholder="Cheses_no"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Engine Capacity</label>
                        <input type="text" id="engine_capacity" name="engine_capacity" placeholder="Engine_capacity"
                            class="form-control">       
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="transports">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Registration No.</label>
                        <input type="text" id="reg_no" name="reg_no" placeholder="Reg_No"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Brand</label>
                        <input type="text" id="brand" name="brand" placeholder="Brand" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <label for="basicpill-address-input" class="form-label">Model</label>
                        <input type="text" id="model" name="model"  placeholder="Model" class="form-control" >        
                    </div>
                </div>
            </div>
            <div class=" py-2" id="btn" >
                <button type="submit" class="btn btn-primary btn-sm float-right">
                <i class="fa fa-dot-circle-o"></i> Submit
                </button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection