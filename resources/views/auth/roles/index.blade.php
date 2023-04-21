@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Roles
                                <a href="" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="fas fa-plus"></i> Add Role</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    @foreach (\Spatie\Permission\Models\Role::where('name', $role['name'])->get() as $rol)      
                                    <tr>
                                        <td>{{$rol['name']}}</td>
                                        <td> 
                                            {{-- <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                <i class="fas fa-eye"></i>
                                             </a> --}}
                                         <a href="{{url('role-edit/'.$rol->id)}}" class="btn btn-outline-warning btn-sm edit" title="Edit"   
                                        >
                                            <i class="fas fa-pencil-alt"></i>
                                         </a>                                       
                                         <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                         data-bs-target="#ModalDelete{{$rol['id']}}">
                                            <i class="fas fa-trash"></i>
                                         </a>
                                        </td>
                                        @include('auth.roles.delete')
                                    {{-- @include('asset.vendor.edit')          --}}
                                    </tr>                    
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div> 


            
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" >Add Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{url('role-store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="itemName-field" class="form-label">Name</label>
                        <input type="text" name="name" id="itemname-field" class="form-control" placeholder="Enter Name" required />
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add-btn">Add Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection