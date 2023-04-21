<form action="{{route('placeorder',$item->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
  <div class="modal fade" id="ModalReq{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light p-3">
          <h5 class="modal-title" id="exampleModalLabel">Make Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            You want to make <b>{{$item->name}}</b> request?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
  </form>

