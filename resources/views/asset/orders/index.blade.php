@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Requests
                                {{-- <a href="" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="fas fa-plus"></i> Add Asset</a> --}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Asset </th>
                                    <th>Staff</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @foreach ($orders as $item)
                                        
                                    <tr>
                                        <td>{{$item->asset->name}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->department->name}}</td>
                                        
                                        
                                            @if($item['status']==1)
                                            <td> <span class="badge rounded-pill badge-soft-success font-size-12 fw-medium">Approved</span></td>
                                            @elseif($item['status']==2)
                                            <td> <span class="badge rounded-pill badge-soft-danger font-size-12 fw-medium">Rejected</span></td>
                                            @elseif($item['status']==3)
                                            <td> <span class="badge rounded-pill badge-soft-secondary font-size-12 fw-medium">Assigned</span></td>
                                            @elseif($item['status']==4)
                                            <td> <span class="badge rounded-pill badge-soft-primary font-size-12 fw-medium">Returned</span></td>
                                            @else
                                            <td> <span class="badge rounded-pill badge-soft-warning font-size-12 fw-medium">Pending</span></td>
                                        @endif

                                        
                                        <td>
                                            @if ($item->status=='2')
                                            
                                            <a class="btn btn-outline-primary btn-sm edit" title="Remarks"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#ModalRemark{{$item['id']}}">
                                            <i class="fas fa-hand-point-up"></i>
                                        </a>
                                        @can('delete-request')
                                        
                                        <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                        data-bs-target="#ModalDelete{{$item['id']}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan

                                            @elseif ($item->status=='1')
                                            
                                            <b>----</b>
                                            @elseif ($item->status=='3')
                                            
                                         <b>----</b>
                                         @elseif ($item->status=='0')
                                         @can('approve-request')
                                         
                                         <a class="btn btn-outline-success btn-sm edit" title="Approve" data-bs-toggle="modal" id="create-btn" 
                                         data-bs-target="#approveModal{{$item['id']}}">
                                         <i class="fas fa-check"></i>
                                        </a>
                                        @endcan
                                        @can('approve-request')
                                        <a class="btn btn-outline-warning btn-sm edit" title="Reject"  data-bs-toggle="modal" id="create-btn" 
                                        data-bs-target="#rejectModal{{$item->id}}">
                                          <i class="fas fa-window-close"></i>
                                        </a>
                                        @endcan
                                     
                                         @else
                                         @can('delete-request')
                                         <a class="btn btn-outline-danger btn-sm edit" title="Delete"  data-bs-toggle="modal" id="create-btn" 
                                         data-bs-target="#ModalDelete{{$item['id']}}">
                                               <i class="fas fa-trash"></i>
                                            </a>
                                            @endcan
                                            @endif
                                        </td>
                                        @include('asset.orders.reject')
                                        @include('asset.orders.approve')
                                        @include('asset.orders.remark')
                                        @include('asset.orders.delete')                  
                                    {{-- @include('asset.vendor.edit')          --}}
                                </tr>  
                                @endforeach
                            </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div> 
            </div> 
@endsection