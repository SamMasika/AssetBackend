@extends('layouts.master')

@section('content')

            {{-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Section
                              
                                    <a href="" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="fas fa-plus"></i> Add Section</a>
                              
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
                                    @foreach ($sections as $item)
                                    
                                    <tr>
                                        @include('asset.section.edit')
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <a href="{{url('section-show/'.$item->id)}}" class="btn btn-outline-info btn-sm edit" title="View"   
                                            >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-outline-warning btn-sm edit" title="Request"  data-bs-toggle="modal" id="create-btn" 
                                        data-bs-target="#EditModal{{$item['id']}}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Request"  data-bs-toggle="modal" id="create-btn" 
                                    data-bs-target="#ModalDelete{{$item['id']}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>   
                            @include('asset.section.delete')
                        </tr>                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div> 


             --}}
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Sections
                    </h2>
                    
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{url('section-list')}}">Section</a>
                        </li>
                    </ol>
                   
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>
                                <a data-toggle="modal" class="btn btn-primary" href="#showmodal"><i class="fa fa-plus"></i>  Add Section</a>
                            </h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                               
                                
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
    
                            <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover test-table" >
                        <thead>
                        <tr>
                            <th> Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $item)
                        <tr >
                            <td>{{$item->name}}</td>
                            <td class="center">A</td>
                        </tr>
                      @endforeach
                       
                        </tfoot>
                        </table>
                            </div>
    
                        </div>
                    </div>
                </div>
                </div>
            </div>



            <div class="ibox-content">
                <div class="text-center">
                
                </div>
                <div id="showmodal" class="modal fade" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header modal-header-centered bg-light p-3">
                                <h3 class="modal-title" >Add Section</h3>
                            </div>
                            <form action="{{url('section-store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="itemName-field" class="form-label">Name</label>
                                        <input type="text" name="name" id="itemname-field" class="form-control" placeholder="Enter Name" required />
                                    </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="add-btn">Add Section</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

          
@endsection