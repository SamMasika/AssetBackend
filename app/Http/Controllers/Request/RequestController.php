<?php

namespace App\Http\Controllers\Request;

use App\Models\Asset;
use App\Models\Building;
use App\Models\Furniture;
use App\Models\Transport;
use App\Models\Electronic;
use App\Models\IssuedAsset;
use App\Models\Unavailable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorHTML;

class RequestController extends Controller
{

    public function index()
    {

        // $user_id = Auth::user()->id;
        // if(Auth::user()->hasRole('super-admin')){
            $requests=Unavailable::all();  
//         }
//        elseif(Auth::user()->hasRole('storekeeper')){
//             $maombi=Maombi::all();
//        }
//        elseif(Auth::user()->hasRole('Maintainance officer')){
//         $maombi=Maombi::all();
//    }
//         else{
//             $maombi=Maombi::where('user_id','=',$user_id)
//             ->get();
//         } 
        return view('asset.asset.unavailable.index',compact('requests'));
    }


    public function create($id)
    {
        $asset=Asset::find($id);
        $departments=Department::all();
        return view('store.orders.create',compact('asset','departments'));
    }

   

    public function show($id)
    {
        $asset=Apply::where('id',$id)->first();

        return view('store.orders.view',compact('asset'));
    }

   

    public function reject(Request $request,$id)
    {
       $requests=Unavailable::find($id);
         $requests->status=$request->status;
         $requests->remark=$request->remark;
         $requests->update();
       return redirect('/requests')->with('success','Request Rejected successfully!');
    }

    public function unavailable(Request $request)
    {
        $user_id=Auth::user()->id;
        $depart_id=Auth::user()->depart_id;
        $unavailable=new Unavailable;
        $unavailable->asset_name=$request->asset_name;  
        $unavailable->user_id= $user_id; 
        $unavailable->depart_id= $depart_id; 
        $unavailable->category=$request->category;
        $unavailable->specification=$request->specification;
        $unavailable->save();  
        return redirect('/asset-list')->with ('success',"Asset Requested successfully!");
    }

  

    // public function maombiApp($id)
    // {
    //     $maombi=Maombi::where('id',$id)->first();
     
    //     return view('store.orders.maombi_approval',compact('maombi'));
    // }

    
    public function approve(Request $request,$id)
    {
       $maombi=Unavailable::find($id);
       $maombi->status='1';
       if( $maombi->update())
      {
        if($maombi->category=='electronic')
        {
            $assets=new Asset();
            $asset_code=rand('106890124','100000000');
            $redcolor='255,0,0';
            $generator = new BarcodeGeneratorHTML(); 
            $barcodes= $generator->getBarcode( $asset_code, $generator::TYPE_STANDARD_2_5,2,60);
          
            $assets->name=$maombi->asset_name;
            $assets->category=$maombi->category;
            $assets->asset_code=$asset_code;
            $assets->user_id= $maombi->user_id;
            $assets->status='new';
            $assets->flug='3';
            $assets->uta=5;
            $assets->request_type=1;
            $assets->barcodes= $barcodes;
           
            if( $assets->save()){
                $electronics=new Electronic;
                $electronics->chapa=$request->chapa;
                 $electronics->modeli=$request->modeli;
                 $electronics->serial_no=$request->serial_no;
                 $electronics->assets_id=$assets->id;
                 $electronics->save();
            }
        }
        if($maombi->category=='furniture')
        {

            $assets=new Asset();
            $asset_code=rand('106890124','100000000');
            $redcolor='255,0,0';
            $generator = new BarcodeGeneratorHTML(); 
            $barcodes= $generator->getBarcode( $asset_code, $generator::TYPE_STANDARD_2_5,2,60);
          
            $assets->name=$maombi->asset_name;
            $assets->category=$maombi->category;
            $assets->asset_code=$asset_code;
            $assets->user_id= $maombi->user_id;
            $assets->status='new';
            $assets->flug='3';
            $assets->uta=10;
            $assets->request_type=1;
            $assets->barcodes= $barcodes;
            if( $assets->save()){
                $furnitures=new Furniture;
                $furnitures->furniture_type=$request->furniture_type;
                $furnitures->assets_id=$assets->id;
                $furnitures->save();
            }
        }
        if($maombi->category=='building')
        {

            $assets=new Asset();
            $asset_code=rand('106890124','100000000');
            $redcolor='255,0,0';
            $generator = new BarcodeGeneratorHTML(); 
            $barcodes= $generator->getBarcode( $asset_code, $generator::TYPE_STANDARD_2_5,2,60);
          
            $assets->name=$maombi->asset_name;
            $assets->category=$maombi->category;
            $assets->asset_code=$asset_code;
            $assets->user_id= $maombi->user_id;
            $assets->status='new';
            $assets->flug='3';
            $assets->uta=20;
            $assets->request_type=1;
            $assets->barcodes= $barcodes;
            if( $assets->save()){
                $buildings = new Building;
                $buildings->size=$request->size;
                $buildings->purpose=$request->purpose;
                $buildings->floor_no=$request->floor_no;
                $buildings->no_of_rooms=$request->no_of_rooms;
                $buildings->assets_id=$assets->id;
                $buildings->save();
            }
        }
        if($maombi->category=='transport')
        {

            $assets=new Asset();
            $asset_code=rand('106890124','100000000');
            $redcolor='255,0,0';
            $generator = new BarcodeGeneratorHTML(); 
            $barcodes= $generator->getBarcode( $asset_code, $generator::TYPE_STANDARD_2_5,2,60);
          
            $assets->name=$maombi->asset_name;
            $assets->category=$maombi->category;
            $assets->asset_code=$asset_code;
            $assets->user_id= $maombi->user_id;
            $assets->status='new';
            $assets->flug='3';
            $assets->uta=10;
            $assets->request_type=1;
            $assets->barcodes= $barcodes;
            if( $assets->save()){
                $transports = new Transport;
                $transports->transport_type=$request->transport_type;
                $transports->cheses_no=$request->cheses_no;
                $transports->reg_no=$request->reg_no;
                $transports->engine_capacity=$request->engine_capacity;
                $transports->brand=$request->brand;
                $transports->model=$request->model;
                $transports->assets_id=$assets->id;
                $transports->save();
            }
        }
        
        if( $assets->save()){
            $modelAss=new IssuedAsset();
            $modelAss->user_id= $assets->user_id;
            $modelAss->assets_id= $assets->id;
            $modelAss-> depart_id=$maombi->depart_id;
            $modelAss->status= 1;
            $modelAss->condtn=$assets->status;
            $modelAss->save();
        }
        return redirect()->back()->with ('success',"Asset added successfully!");
      }
       return redirect('/apply-list')->with('status','Request updated successfully!');
    }

    public function destroy($id)
    {
       return $apply=Unavailable::find($id);
        $apply->delete();
        return redirect()->back()->with('success','Request deleted successfully!');
       
    }    
}
