<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Asset;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
      $orders=Order::with('asset')->with('department')->with('user')->where('flug',1)->get();
      $orderCount=Order::where('flug',1)->count();
      $pending=Order::where('flug',1)->where('status','0')->count();
      return response()->json(['success'=>true,'status'=>300, 'data'=> $orders,'count'=>$orderCount, 'pending'=>$pending],200); 
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
     return response()->json([
      'success'=>true,
      'status'=>300,
      'message'=>'Request Approved successfully!',
  ]);
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
     return response()->json([
      'success'=>true,
      'status'=>300,
      'message'=>'Request Approved successfully!',
  ]);
    }

   
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
            $orders=Order::find($id);
            $orders->delete();
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Order Deleted successfully!',
            ]);
    }
}
