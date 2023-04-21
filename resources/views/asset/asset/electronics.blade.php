@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Electronics
                                @can('add-asset') 
                                <a href="" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="fas fa-plus"></i> Add Asset</a>
                                @endcan
                                @can('generate-pdf')  
                                <a href="{{url('generate-pdf')}}" class="btn btn-primary waves-effect waves-light" ><i class="fas fa-file-pdf"></i> PDF</a>
                                @endcan
                            </h4>
                        </div>
                        
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>AssetCode</th>
                                    <th>Request</th>
                                    <th>Availability</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($electronics as $item)
                                        
                                    <tr>
                                        <td>{{$item['name']}}</td>
                                        <td>{{$item['asset_code']}}</td>
                                        
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

                                        <td>
                                            @if ($item->status=='broken')
                                            <b>To be repaired</b>  
                                            @else
                                            @if ($item->flug==1)
                                            
                                            <a  href="{{url('asset-show/'.$item->id)}}" class="btn btn-outline-info btn-sm edit" title="View"  id="create-btn" 
                                            >
                                            <i class="fas fa-eye"></i>
                                            </a>

                                            @elseif ($item->flug==2)
                                            @can('view-asset')
                                                
                                            <a  href="{{url('asset-show/'.$item->id)}}"  class="btn btn-outline-info btn-sm edit" title="View"  id="create-btn" 
                                            >
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            @endcan
                                            {{-- <a class="btn btn-outline-warning btn-sm edit" title="Edit" data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#EditModal{{$item['id']}}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a> --}}
                                        @can('assign-asset')   
                                        <a  href="{{ url('assign-view/' . $item->id) }}" class="btn btn-outline-success btn-sm edit" title="Assign"  id="create-btn">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        @endcan
                                        @can('delete-asset') 
                                        <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                        data-bs-target="#ModalDelete{{$item['id']}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
                                    
                                    @elseif ($item->flug==3)
                                    @can('view-asset')
                                                
                                            <a  href="{{url('asset-show/'.$item->id)}}"  class="btn btn-outline-info btn-sm edit" title="View"  id="create-btn" 
                                            >
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            @endcan
                                    {{-- <a class="btn btn-outline-warning btn-sm edit" title="Edit" data-bs-toggle="modal" id="create-btn" 
                                    data-bs-target="#EditModal{{$item['id']}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a> --}}
                                @can('assign-asset')       
                                <a  href="{{ url('unassign-view/' . $item->id) }}" class="btn btn-outline-success btn-sm edit" title="Unassign"  id="create-btn">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                                @endcan
                                @can('delete-asset') 
                                <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                data-bs-target="#ModalDelete{{$item['id']}}">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endcan
                                            
                                            
                                            
                                            @else
                                            @can('view-asset')
                                                
                                            <a  href="{{url('asset-show/'.$item->id)}}"  class="btn btn-outline-info btn-sm edit" title="View"  id="create-btn" 
                                            >
                                            <i class="fas fa-eye"></i>
                                            </a>
                                            @endcan
                                            {{-- <a class="btn btn-outline-warning btn-sm edit" title="Edit" data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#EditModal{{$item['id']}}">
                                               <i class="fas fa-pencil-alt"></i>
                                            </a> --}}
                                            
                                            <a class="btn btn-outline-primary btn-sm req" title="Request"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalReq{{$item['id']}}">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        @can('delete-asset') 
                                        <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                        data-bs-target="#ModalDelete{{$item['id']}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
                                    {{-- @include('asset.asset.edit') --}}
                                    @endif
                                    @endif
                                    @include('asset.asset.delete')         
                                    @include('asset.orders.order')
                                    </td>
                                    </tr>                    
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> 
            </div> 

    
    
   


            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" >Add Asset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form action="{{ url('asset-store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- 
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="selectSm" class=" form-control-label">
                                Vendor</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="vendor_id" id="SelectLm" class="form-control">
                                    <option value="0">--Vendor--</option>
                                    @foreach ($vendors as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        --}}
                        <div class="modal-body">
                        <div class="row py-1">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="basicpill-address-input" class="form-label">Category</label>
                                    <select name="category" id="asset_cat" class="form-control">
                                        <option value="">--Category--</option>
                                        <option value="electronic">Electronic</option>
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
                                    {{-- <label for="firstnamefloatingInput">Status</label> --}}
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