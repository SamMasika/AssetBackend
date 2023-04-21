<?php

namespace App\Http\Controllers\Order;

use App\Models\Asset;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
        
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
            $orders=Order::where('user_id','=',$user_id)->where('flug',1)
            ->get();
        };
     
       return view('asset.orders.index',compact('orders'));
    }

    public function show($id)
    {
        $asset=Order::where('id',$id)->first();

        return view('store.orders.view',compact('asset'));
    }

    public function approve(Request $request,$id)
    {
       $order=Order::find($id);
        $asset_id=$order->assets_id;
     $assets=Asset::where('id',$asset_id)->first();
     if($order){
         $order->status=$request->status;
         $order->update();
     
            if($order->status=='1')
            {

                $assets->flug='2';
                $assets->update();    
            }
            if($order->status=='2')
            {

                $assets->flug='0';
                $assets->update();    
            } 
      
     }
       return redirect('/asset-list')->with('status','Request Approved successfully!');
    }


    public function reject(Request $request,$id)
    {
       $order=Order::find($id);
        $asset_id=$order->assets_id;
     $assets=Asset::where('id',$asset_id)->first();
     if($order){
         $order->status=$request->status;
         $order->remark=$request->remark;
         $order->update();
     
            if($order->status=='1')
            {

                $assets->flug='2';
                $assets->update();    
            }
            if($order->status=='2')
            {

                $assets->flug='0';
                $assets->update();    
            } 
      
     }
       return redirect('/order-list')->with('status','Request Rejected successfully!');
    }
    public function destroy($id)
    {
        $orders=Order::find($id);
        $orders->flug=0;
        $orders->update();
        return redirect()->back()->with('status','Order deleted successfully!');
    }
    
    public function placeorder(Request $request,$id)
    {
        $asset=Asset::find($id);
        $user_id=Auth::user()->id;
        $depart_id=Auth::user()->depart_id;
        if($asset)
        {
            $order=new Order;
            $order->assets_id=$asset->id;
            $order->user_id= $user_id;
          $order->depart_id= $depart_id;
            $order->status='0';
            $order->save();
            if( $order->save())
            {
                $asset->flug='1';
                $asset->update();
            }
            return redirect('/order-list')->with('status','Asset Ordered Successfully!');
        }
    }
}
