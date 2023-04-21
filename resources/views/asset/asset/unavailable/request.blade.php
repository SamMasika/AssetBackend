<div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" >Asset Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{ url('unavailable') }}" method="post" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <div class="mb-3">
                        <select name="category"  class="form-control">
                            <option value="">--Category--</option>
                            <option value="furniture">Furniture</option>
                            <option value="electronic">Electronic</option>
                            <option value="building">Building</option>
                            <option value="transport">Transport</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="text" id="name" name="asset_name" placeholder="Name"  class="form-control" >        
                    </div>
                </div>
            </div>
           
       
            <div class="row py-1" >
                <div class="col-md-12">
                    <div class="mb-3">
                        <textarea name="specification" id="purpose" rows="3" maxlength = "40"
                            placeholder="Specification..." class="form-control"></textarea>       
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
