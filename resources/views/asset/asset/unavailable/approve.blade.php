
<div class="modal fade" id="approveModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" >Approve</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ url('approve-request/'.$item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <div class="row py-1">
                <div class="col-md-4">
                    <div class="mb-3">
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
                        {{-- <label for="basicpill-address-input" class="form-label">Action</label> --}}
                        <select name="status" id="SelectLm" class="form-control">
                            <option value="">--Action--</option>
                            <option value="1">Approve</option>

                        </select>
                        {{-- <label for="firstnamefloatingInput">Status</label> --}}
                    </div>
                </div>
              
                <div class="col-md-4" >
                    <div class="mb-3">
                        <input type="date" id="purchase_date" name="purchase_date" placeholder="Purchase Date" class="form-control" >        
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="furniture">
                <div class="col-md-12" >
                    <div class="mb-3">
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
                        <input type="text" id="chapa" name="chapa" placeholder="Brand" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <input type="text" id="modeli" name="modeli"  placeholder="Model" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <input type="text" id="serial_no" name="serial_no" placeholder="Serial Number" class="form-control" >        
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="building">
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="number" id="size" name="size" placeholder="Size"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="number" id="floor_no" name="floor_no" placeholder="Floors"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="number" id="no_of_rooms" name="no_of_rooms" placeholder="Rooms"
                            class="form-control">       
                    </div>
                </div>
            </div>
            <div class="row py-1" id="buildings" style="display: none">
                <div class="col-md-12">
                    <div class="mb-3">
                        <textarea name="purpose" id="purpose" rows="3" maxlength = "40"
                            placeholder="Purpose..." class="form-control"></textarea>       
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="transport">
                <div class="col-md-4">
                    <div class="mb-3">
                        <select name="transport_type" id="transport_type" class="form-control">
                            <option value="">--Transport_Type--</option>
                            <option value="vehicle">Vehicle</option>
                            <option value="bajaj">Bajaj</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" id="cheses_no" name="cheses_no" placeholder="Cheses_no"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" id="engine_capacity" name="engine_capacity" placeholder="Engine_capacity"
                            class="form-control">       
                    </div>
                </div>
            </div>
            <div class="row py-1" style="display: none" id="transports">
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" id="reg_no" name="reg_no" placeholder="Reg_No"
                            class="form-control">       
                    </div>
                </div>
                <div class="col-md-4" >
                    <div class="mb-3">
                        <input type="text" id="model" name="model"  placeholder="Model" class="form-control" >        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <input type="text" id="brand" name="brand" placeholder="Brand" class="form-control" >        
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