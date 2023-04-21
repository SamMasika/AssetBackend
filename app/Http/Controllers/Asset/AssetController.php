<?php

namespace App\Http\Controllers\Asset;

use App\Models\Info;
use App\Models\User;
use App\Models\Asset;
use App\Models\Order;
use App\Models\Repair;
use App\Models\Building;
use App\Models\Disposal;
use PDF;
use App\Models\Furniture;
use App\Models\Transport;
use App\Models\Electronic;
use App\Models\IssuedAsset;
use App\Models\Unavailable;
use App\Models\Maintainance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller
{
     
    public function index()
    {
        $assets=Asset::where('status','!=','disposed')->where('control',1)->get();
      $computer=Asset::where('name','computer')->where('control',1)->get();
      $meza=Asset::where('name','meza')->where('control',1)->get();
      $chair=Asset::where('name','chair')->where('control',1)->get();
           return view('asset.asset.index',compact('assets','computer','meza','chair'));
    }

    public function electronics()
    {
        $electronics=Asset::where('category','electronic')->where('control',1)->where('status','!=','disposed')->where('status','!=','broken')->get();
        return view('asset.asset.electronics',compact('electronics'));
    }

    public function furniture()
    {
        $furniture=Asset::where('category','furniture')->where('control',1)->where('status','!=','disposed')->where('status','!=','broken')->get();
        return view('asset.asset.furniture',compact('furniture'));
    }
    public function buildings()
    {
        $buildings=Asset::where('category','building')->where('control',1)->where('status','!=','disposed')->where('status','!=','broken')->get();
        return view('asset.asset.buildings',compact('buildings'));
    }

    public function transport()
    {
        $transports=Asset::where('category','transport')->where('control',1)->where('status','!=','disposed')->where('status','!=','broken')->get();
        return view('asset.asset.transport',compact('transports'));
    }
  
 

    public function update(Request $request,$id)
    {
        $assets=Asset::find($id);
        $asset_code=rand('106890124','100000000');
        $redcolor='255,0,0';
         $barcodes=QrCode::size(100)->generate($asset_code);
        // $generator = new BarcodeGeneratorHTML(); 
        // $barcodes= $generator->getBarcode( $asset_code, $generator::TYPE_STANDARD_2_5,2,60);
      
        $assets->name=$request->name;
        $assets->category=$request->category;
      $assets->vendor_id=$request->vendor_id;
        $assets->user_id=$request->user_id;
        $assets->asset_code=$asset_code;
        $assets->status=$request->status;
        $assets->uta=$request->uta;
        $assets->p_price=$request->p_price;
      $assets->barcodes= $barcodes;
       $assets->purchase_date=$request->purchase_date;
        $assets->manufactured_year=$request->manufactured_year;
        
         if( $assets->save()){
            if($assets->category=='electronic'){
                $electronics=Electronic::where('assets_id',$id)->first();
                $electronics->chapa=$request->chapa;
                 $electronics->modeli=$request->modeli;
                $electronics->serial_no=$request->serial_no;
                //  $electronics->assets_id=$assets->id;
                $electronics->save();
            }   
            if($assets->category=='furniture')
            {
                $furnitures=Furniture::where('assets_id',$id)->first();
                $furnitures->furniture_type=$request->furniture_type;
                // $furnitures->assets_id=$assets->id;
                $furnitures->save();
            }
            if($assets->category=='building')
            {
                $buildings = Building::where('assets_id',$id)->first();
                $buildings->size=$request->size;
                $buildings->purpose=$request->purpose;
                $buildings->floor_no=$request->floor_no;
                $buildings->no_of_rooms=$request->no_of_rooms;
                // $buildings->assets_id=$assets->id;
                $buildings->save();
            }

            if($assets->category=='transport')
            {
                $transports =Transport::where('assets_id',$id)->first();
                $transports->transport_type=$request->transport_type;
                $transports->cheses_no=$request->cheses_no;
                $transports->reg_no=$request->reg_no;
                $transports->engine_capacity=$request->engine_capacity;
                $transports->brand=$request->brand;
                $transports->model=$request->model;
                // $transports->assets_id=$assets->id;
                $transports->save();
            }
        //    $assets=Asset::create( $request->all());
         }
        return redirect('/asset-list')->with('success','Asset Updated Successfully!');
    }

    public function assignView($id)
    {
        $assets=Asset::find($id);
      $staffs=User::where('flug',1)->get(); 
     $request=Order::where('assets_id',$id)->where('status','1')->first();
     return view('asset.asset.assign',compact('staffs','assets','request'));  
    }
    public function assignAsset(Request $request,$id)
    {
        $asset=Asset::find($id);
        $order=Order::where('assets_id',$id)->first();
    //    $staffs=IssuedAsset::with('user')->where('assets_id',$id)->first();
        if($asset)
        {
            $asset->user_id = $request->user_id;
            $asset->status = $request->status;
            $asset->flug = '3';
        }
       if($asset->update()){
           $modelAss=new IssuedAsset();
           $modelAss->user_id=$request->user_id;
           $modelAss->assets_id= $id;
           $modelAss->depart_id= $order->depart_id;
           $modelAss->status= 1;
           $modelAss->condtn=$asset->status;
           $modelAss->save();
       }
       if($asset->update()){
       $order->status='3';
        $order->update();
       }
        return redirect('/asset-list')->with('status','Asset Assigned successfully!');
    }

    public function unassignView($id)
    {
        $assets=Asset::find($id);
      $staff=User::with('asset')->get(); 
     return view('asset.asset..unassign',compact('assets','staff'));  
    }

    public function assetUnassign(Request $request ,$id)
    {
        $asset=Asset::find($id);
    $asset_name= $asset->name;
       $issued=IssuedAsset::where('assets_id',$id)->latest()->first();
      $issued_i=IssuedAsset::where('assets_id',$id)->where('status',1)->latest()->first();
        if($asset){
            $asset->user_id = NULL;
            $asset->status =$request->status;
            $asset->flug ='0';
            if($asset->update())
            {
                $asset_un=Asset::where('id',$id)->first();
                $asset_un->request_type=0;
                $asset_un->update();
            }
            if($asset->update())

            {
                $curi=new IssuedAsset;
                $curi->assets_id = $id;
                $curi->user_id= $issued->user_id; 
                $curi->depart_id= $issued->depart_id; 
                $curi->condtn= $asset->status; 
                $curi->status=0; 
                $curi->save();
            }
            if($asset->update())

            {
                $curi_i= $issued_i;
                $curi_i->delete();
            }
            if($asset->update())
            {
                
                $infos = new Info;
                $infos->assets_id = $id;
                $infos->user_id= $issued->user_id; 
                $infos->depart_id= $issued->depart_id; 
               $infos->condtn= $asset->status; 
                $infos->status=0; 
                $infos->status_i=$issued->status; 
                $infos->assigned=$issued->created_at; 
                $infos->condtn_i=$issued->condtn; 
                $infos->reason=$request->reason; 
                $infos->save(); 
             }
             if($asset->update())
             {
                 if($asset->status=='broken')
                 {
                    $maintain=new Maintainance;
                    $maintain->assets_id= $id;
                    $maintain->condtn= $asset->status;
                    $maintain->returned_at= $asset->created_at;
                    $maintain->save();
                 }
             }
             if($asset->update()){
                if($asset->request_type==0){
                    $request=Order::where('assets_id',$id)->first();
                     $request->flug=0;
                     $request->update();
                }
             else{
                    $ombi=Unavailable::where('asset_name', $asset_name)->first();
                     $ombi->delete();
                    }
                }
        }
        return redirect('/asset-list')->with('status','Asset returned successfully!');
    }

    public function workshop()
    {
        $maintains=Maintainance::where('flug',1)->get();
        return view('asset.asset.maintainance',compact('maintains'));
    }

    public function repair(Request $request,$id)
    {
        $repair=Maintainance::find($id);
        $rep_id=$repair->assets_id;
        $maintains=Asset::where('id',$rep_id)->first();
        if( $repair)
        { 
            $repair->condtn=$request->condtn;
            if( $repair->update())
            {
                if( $repair->condtn=='disposed'){
                    $disposal=new Disposal;
                    $disposal->assets_id= $rep_id;
                    $disposal->condtn_m="disposed";
                    $disposal->save(); 

                    $disp=$maintains; 
                    $disp->status=$repair->condtn;
                    $disp->update();
                    if($disp->update())
                    {
                       $repair->delete();
                    }
                }elseif($repair->condtn=='repaired'){
                   $history=new Repair;
                 $history->assets_id= $rep_id;
                  $history->flug="broken";
                 $history->save();

                 $repaired=$maintains;
                 $repaired->status=$repair->condtn;
                 $repaired->update();

                 if($repaired->update())
                 {
                    $repair->delete();
                 }
                } 
            }
            return redirect('/asset-list')->with('status','Asset repaired successfully!');
        }
    }

    public function disposal()
    {
        $disposal=Disposal::where('flug',1)->get();
        return view('asset.asset.disposal',compact('disposal'));
    }

    public function destroyDisposal($id)
    {
        $disp=Disposal::find($id);
        $disp_id=$disp->assets_id;
       $asset=Asset::where('id', $disp_id)->first();
       $asset->delete();
       return redirect()->back()->with('status','Asset Deleted Successfully!');
    }

    public function show($id)
    {
        $asset= Asset::find($id);
       $electronic=Electronic::where('assets_id',$id)->first();
        $building=Building::where('assets_id',$id)->first();
        $furniture=Furniture::where('assets_id',$id)->first();
        $transport=Transport::where('assets_id',$id)->first();
        $infos = Info::select('*')
       ->where('assets_id',$id)
       ->orderBy('created_at', 'desc')
       ->get()
       ->unique('user_id');
       return view('asset.asset.view',compact('asset','electronic','building','furniture','transport','infos'));
       
    }
 
  

    public function generatePDF()
    {
      $data = Asset::where('control',1)->get();
       $pdf = PDF::loadView ('asset.asset.myPDF',compact('data'));
        return $pdf->download('Assets.pdf');
    }
    

    public function destroy($id)
    {
            $assets=Asset::find($id);
            $assets->delete();
            return redirect('asset-list')->with('status','Asset deleted successfully!');
    }
}
