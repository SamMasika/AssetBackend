@extends('layouts.master')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Assets To be Repaired
                            
                            </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Asset</th>
                                    <th>Disposed@</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disposal as $item)
                                        
                                    <tr>
                                        <td>{{$item->asset->name}}</td>
                                        <td>{{date('d/M/y', strtotime($item->created_at))}}</td>
                                         <td>
                                            <a class="btn btn-outline-danger btn-sm edit" title="Request"  data-bs-toggle="modal" id="create-btn" 
                                            data-bs-target="#repairModal{{$item['id']}}">
                                               <i class="fas fa-trash"></i>
                                            </a>
                                         {{-- @include('asset.asset.repair') --}}
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