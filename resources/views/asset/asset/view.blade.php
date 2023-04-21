@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title "> Asset Details| <a href="{{url('asset-list')}}"  > <i class="fas fa-arrow-alt-circle-left"></i>Assets</a></h4>
             </div>
            <div class="card-body">
               
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Category</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$asset->category}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Status</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$asset->status}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$asset->name}}" readonly  class="form-control" >        
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Purchasing Price</label>
                            <input type="number" id="p_price" name="p_price" value="{{$asset->p_price}}" readonly placeholder="Purchasing Price" class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Use life</label>
                            <input type="number" id="UTA" name="uta" value="{{$asset->uta}}" readonly placeholder="Useful-Life" class="form-control"> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            @if ($asset->manufactured_year==null)
                            <label for="basicpill-address-input" class="form-label">Manufactured Year</label>
                            <input type="year" id="manufactured_year" name="manufactured_year" value="--" readonly placeholder="Manufactured_year"
                                class="form-control">
                                @else
                                <label for="basicpill-address-input" class="form-label">Manufactured Year</label>
                                <input type="year" id="manufactured_year" name="manufactured_year" value="{{$asset->manufactured_year}}" readonly placeholder="Manufactured_year"
                                    class="form-control">       
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Purchase Date</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{date('d/M/y', strtotime($asset->purchase_date))}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            @if ($asset->user_id==null)
                            <label for="basicpill-address-input" class="form-label"> Staff Name</label>
                            <input type="year" id="manufactured_year" name="manufactured_year" value="--" readonly placeholder="Manufactured_year"
                                class="form-control">
                                @else
                                <label for="basicpill-address-input" class="form-label"> Staff Name</label>
                                <input type="year" id="manufactured_year" name="manufactured_year" value="{{$asset->user->name}}" readonly placeholder="Manufactured_year"
                                    class="form-control">       
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            @if ($asset->user_id==null)
                            <label for="basicpill-address-input" class="form-label"> Staff Phone</label>
                            <input type="year" id="manufactured_year" name="manufactured_year" value="--" readonly placeholder="Manufactured_year"
                                class="form-control">
                                @else
                                <label for="basicpill-address-input" class="form-label"> Staff Phone</label>
                                <input type="year" id="manufactured_year" name="manufactured_year" value="{{$asset->user->phone}}" readonly placeholder="Manufactured_year"
                                    class="form-control">       
                            @endif
                        </div>
                    </div>
                </div>
                @if ($asset->category=='electronic')
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Brand</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$electronic->chapa}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Model</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$electronic->modeli}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Serial No.</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$electronic->serial_no}}" readonly  class="form-control" >        
                        </div>
                    </div>
                </div>
                @else

                @endif
                @if ($asset->category=='transport')
               
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Transport Type</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->transport_type}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Cheses No.</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->cheses_no}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Reg No.</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->reg_no}}" readonly  class="form-control" >        
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Engine Capacity</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->engine_capacity}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Brand</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->brand}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Model</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$transport->model}}" readonly  class="form-control" >        
                        </div>
                    </div>
                </div>
                @else

                @endif
                
                @if ($asset->category=='furniture')
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Furniture Type</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$furniture->furniture_type}}" readonly class="form-control" >        
                        </div>
                    </div>
                </div>
                @else

                @endif
                @if ($asset->category=='building')
               
                <div class="row py-1">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Size</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$building->size}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">No. of Floors</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$building->floor_no}}" readonly class="form-control" >        
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">No. of Rooms</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$building->no_of_rooms}}" readonly  class="form-control" >        
                        </div>
                    </div>
                </div>
                <div class="row py-1">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Purpose</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$building->purpose}}" readonly class="form-control" >        
                        </div>
                    </div>
                    
                </div>
                @else

                @endif
                <div class="row py-1">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="basicpill-address-input" class="form-label">Asset Code</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{$asset->asset_code}}" readonly class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                     <label for="basicpill-address-input" class="form-label">QR Code</label>
                            {!!$asset->barcodes!!}    
                        </div>
                    </div>
                    
                </div>
               
                <a href="{{url('asset-list')}}"  > Back</a>
            </div>
        </div>
    </div> 
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title ">Assignment History
                    {{-- <a href="" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="fas fa-plus"></i> Add Asset</a> --}}
                </h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        
                        <th>FullName</th>
                        <th>Phone</th>
                        <th>Assigned</th>
                        <th>Returned</th>
                        <th>Assigned Date</th>
                        <th>Return Date</th>
                    </tr>
                    </thead>


                    <tbody>
                     
                            @foreach ($infos as $item)
                                
                            <tr>
                               
                              

                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td > {{$item->user->name}}</td>
                                @endif
                                
                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td > {{$item->user->phone}}</td>
                                @endif
                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td > {{$item->condtn_i}}</td>
                                @endif
                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td > {{$item->condtn}}</td>
                                @endif
                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td >{{date('d/M/y', strtotime($item->assigned))}}</td>
                                @endif

                                @if ($item==NULL)
                                <td ></td>
                                @else
                                <td > {{date('d/M/y', strtotime($item->created_at))}} </td>
                                @endif

                            </tr>                    
                            @endforeach
                     
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div> 



@endsection
