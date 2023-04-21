@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title ">Requests
                               
                            </h4>
                        </div>
                        
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            
                            
                            <tbody>
                                @foreach ($requests as $item)
                                
                                <tr>
                                     @include('asset.asset.unavailable.delete')         
                                              
                                    <td>{{$item->asset_name}}</td>
                                    @include('asset.asset.unavailable.approve') 
                                        <td>{{$item->user->name}}</td>
                                        
                                            @if($item['status']==0)
                                            <td> <span class="badge rounded-pill badge-soft-primary font-size-12 fw-medium">Pending</span></td>
                                            @elseif($item['status']==1)
                                            <td> <span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">Assigned</span></td>
                                            @elseif($item['status']==2)
                                            <td> <span class="badge rounded-pill badge-soft-danger font-size-12 fw-medium">Rejected</span></td>
                                            @elseif($item['status']==3)
                                            <td> <span class="badge rounded-pill badge-soft-secondary font-size-12 fw-medium">Returned</span></td>
                                        @endif

                                      
                                         <td>
                                            @if ($item->status==0)
                                                
                                            <a class="btn btn-outline-success btn-sm edit" title="Approve" data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#approveModal{{$item['id']}}">
                                               <i class="fas fa-check"></i>
                                           </a>
                                            <a class="btn btn-outline-warning btn-sm edit" title="Reject" data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#rejectModal{{$item['id']}}">
                                               <i class="fas fa-window-close"></i>
                                            </a>
                                          
                                            
                                            @elseif($item->status==1)
                                           
                            
                                            <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalDelete{{$item['id']}}">
                                               <i class="fas fa-trash"></i>
                                            </a>
                                            <a class="btn btn-outline-primary btn-sm edit" title="More"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalDelete{{$item['id']}}">
                                               <i class="fas fa-level-down-alt"></i>
                                            </a>
                                            @elseif($item->status==2)
                                           
                                          
                                            <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalDelete{{$item['id']}}">
                                               <i class="fas fa-trash"></i>
                                            </a>
                                            <a class="btn btn-outline-primary btn-sm edit" title="More"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalDelete{{$item['id']}}">
                                               <i class="fas fa-level-down-alt"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>                    
                                    @include('asset.asset.unavailable.reject')         
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>       
            @endsection