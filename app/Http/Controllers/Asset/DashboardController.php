<?php

namespace App\Http\Controllers\Asset;

use App\Models\User;
use App\Models\Asset;
use App\Models\Order;
use App\Models\Disposal;
use App\Models\Maintainance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   
    public function index()
    {
        $assets=Asset::all();
        $users=User::where('flug',1)->get();
        $maintains=Maintainance::where('flug',1)->get();
         $user=Auth::user();
        $disposal=Disposal::where('flug',1)->get();
        $assigned_asset=Asset::where('user_id','!=',NULL)->get();
        $user_id = Auth::user()->id;
        
        if(Auth::user()->hasRole('Admin')){
            $orders=Order::where('flug',1)->get();
        }
       elseif(Auth::user()->hasRole('Head of NIDC')){
            $orders=Order::where('flug',1)->get();
       }
         elseif(Auth::user()->hasRole('Asset Manager')){
         $orders=Order::where('flug',1)->get();
        }
        elseif(Auth::user()->hasRole('Section Manager')){
            $orders=Order::where('flug',1)->get();
           }
           elseif(Auth::user()->hasRole('Human Resource Manager')){
            $orders=Order::where('flug',1)->get();
           }
        else{
            $orders=Order::where('user_id','=',$user_id)->where('flug',1)->get();
           
        };
        return view('dashboard',compact('assets','users','disposal','assigned_asset','user','maintains','orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
