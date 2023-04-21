@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title ">Assets To be Repaired
                            
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Condition</th>
                                    <th>Brought@</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maintains as $item)
                                        
                                    <tr>
                                        <td>{{$item->asset->name}}</td>
                                        <td>{{$item->condtn}}</td>
                                        <td>{{date('d/M/y', strtotime($item->created_at))}}</td>
                                         <td>
                                            @can('repair-asset')  
                                            <a class="btn btn-outline-primary btn-sm edit" title="Repair"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#repairModal{{$item['id']}}">
                                               <i class="fas fa-wrench"></i>
                                            </a>
                                            @endcan
                                         @include('asset.asset.repair')
                                    </td>
                                    </tr>                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div> 
@endsection