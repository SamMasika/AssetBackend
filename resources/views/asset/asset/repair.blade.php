<div class="modal fade" id="repairModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" >Repair</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('repair/'.$item->id) }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row  ">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Asset</label>
                                <input type="text" id="name" name="name" placeholder="Name"  class="form-control" value="{{ $item->asset->name }}" >        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Action</label>
                                <select name="condtn" id="SelectLm" class="form-control">
                                    <option value="{{ $item->status }}">{{ $item->status }}</option>
                                    <option value="repaired">Repair</option>
                                    <option value="disposed">Dispose</option>
                                </select>
                                {{-- <label for="firstnamefloatingInput">Status</label> --}}
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