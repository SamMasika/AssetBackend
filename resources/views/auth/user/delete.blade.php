
<form action="{{route('delete.user',$item->id)}}"  method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
  <div class="modal fade" id="ModalDelete{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-light p-3">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">

            Are you sure you want to delete <b>{{$item->name}}</b>?
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
      </div>
    </div>
  </div>
  </form>