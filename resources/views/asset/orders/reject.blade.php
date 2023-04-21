<div class="modal fade" id="rejectModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" >Reject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('reject/'.$item->id) }}" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    @csrf
                    <div class="row  ">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Action</label>
                                <select name="status" id="SelectLm" class="form-control" required>
                                    <option value="">--Action--</option>
                                    <option value="2">Reject</option>
                                </select>
                                {{-- <label for="firstnamefloatingInput">Status</label> --}}
                            </div>
                        </div>
                    </div>  
                    <div class="row py-1">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="basicpill-address-input" class="form-label">Remark</label>
                                <textarea id="basicpill-address-input" required name="remark" class="form-control" rows="2" placeholder="Enter your Reason........."></textarea>
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