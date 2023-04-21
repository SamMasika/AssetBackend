@extends('layouts.master')

@section('content') 
        <div class="row">
            <div class="col-md-3">
                <div class="card mini-stats-wid">
                    <a href="{{url('asset-list')}}">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Assets in {{$depart->name}} Section</p>
                                <h4 class="mb-0">{{$issued->count()}}</h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-store font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            </div>  
        </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title ">{{$depart->name}} Section Assets|
                                 <a href="{{url('section-list')}}"  >  <i class="fas fa-arrow-alt-circle-left"></i> Sections</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Staff</th>
                                    <th>Asset</th>
                                </tr>
                            </thead>
                                <tbody>
                                  
                                    
                                    @foreach ($issued as $issue)  
                                    <tr>
                                        <td>{{$issue->user->name}}</td>
                                        <td>{{$issue->asset['name']}}</td>
                                    </tr>
                                    @endforeach      
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer float-right col-3">
                        Total Number of Assets Assigned is: <h6 class="text-success"><b>{{$issued->count()}} Asset(s)</b></h6>  
                      
                      
                      </div>
                </div> 
            </div>      

          
           
@endsection