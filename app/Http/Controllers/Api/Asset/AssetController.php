<?php

namespace App\Http\Controllers\Api\Asset;

use App\Models\Info;
use App\Models\User;
use App\Models\Asset;
use App\Models\Order;
use App\Models\Repair;
use App\Models\Building;
use App\Models\Disposal;
use App\Models\Furniture;
use App\Models\Transport;
use App\Models\Electronic;
use App\Models\IssuedAsset;
use App\Models\Maintainance;
use Illuminate\Http\Request;
use App\Enums\AssetCategoryEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorHTML;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller
{
    public function index()
        {
           $assets=Asset::where('status','!=','DISPOSED')->where('control',1)->get();
           $assetCat = Asset::where('control',1)->count();
               return response()->json(['success'=>true,'status'=>300, 'data'=> $assets,'count'=> $assetCat],200); 
        }

            public function assetsByCategory()
            {
    $assets=Asset::where('status','!=','DISPOSED')->where('control',1)->get();
        $countsByCategory = $assets->groupBy('category')->map->count();
        return response()->json( $countsByCategory,200);
            }

            public function status()
    {
        $statuses = Asset::groupBy('status')->where('status','!=','DISPOSED')->where('control',1)
        ->selectRaw('count(*) as count, status')
        ->get();
    $chartData = [];
    foreach ($statuses as $status) {
        $chartData[] = [
            'name' => $status->status,
            'count' => $status->count
        ];
    }
    return response()->json($chartData);
    }
        public function faults()
        {
            $electronics=Maintainance::where('flug',1)->get();
            $faultsCount = Maintainance::where('flug',1)->count();
            return response()->json(['success'=>true,'status'=>300, 'data'=> $electronics,'count'=>$faultsCount ],200);
        }

        public function electronics()
    {
        $electronics=Asset::where('category','ELECTRONIC')->where('control',1)->where('status','!=','DISPOSED')->get();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $electronics ],200);
    }

    public function furniture()
    {
        $furniture=Asset::where('category','FURNITURE')->where('control',1)->where('status','!=','DISPOSED')->get();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $furniture ],200);
    }
    public function buildings()
    {
        $buildings=Asset::where('category','BUILDING')->where('control',1)->where('status','!=','DISPOSED')->get();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $buildings ],200);
    }

    public function vehicles()
    {
        $vehicles=Asset::where('category','TRANSPORT')->where('control',1)->where('status','!=','DISPOSED')->get();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $vehicles ],200);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string',
        'p_price' => '',
        'purchase_date' => '',
        'uta' => '',
        'category' => 'required|in:ELECTRONIC,FURNITURE,BUILDING,TRANSPORT',
        'status' => 'required',
        'manufactured_year' => 'required',
        'chapa' => 'required_if:category,ELECTRONIC',
        'modeli' => 'required_if:category,ELECTRONIC',
        'serial_no' => 'required_if:category,ELECTRONIC',
        'furniture_type' => 'required_if:category,FURNITURE',
        'size' => 'required_if:category,BUILDING',
        'purpose' => 'required_if:category,BUILDING',
        'floor_no' => 'required_if:category,BUILDING',
        'no_of_rooms' => 'required_if:category,BUILDING',
        'transport_type' => 'required_if:category,TRANSPORT',
        'cheses_no' => 'required_if:category,TRANSPORT',
        'reg_no' => 'required_if:category,TRANSPORT',
        'engine_capacity' => 'required_if:category,TRANSPORT',
        'brand' => 'required_if:category,TRANSPORT',
        'model' => 'required_if:category,TRANSPORT',
        ]);
       $records=Asset::all();
       if(count($records)>0){
           $lastorderId = Asset::orderBy('id', 'desc')->first()->asset_code;
       }else{
        $lastorderId = "NIDC*000000";
    }
    $lastIncreament = substr($lastorderId, -6);
       $asset_code = 'NIDC*' . str_pad((int)$lastIncreament + 1, 6, 0, STR_PAD_LEFT);
        $redcolor='255,0,0';
        $barcodeValue = $validatedData['name']. '-' . $validatedData['category'] . '-' . $asset_code;
        //  $barcodes=QrCode::size(100)->generate($asset_code);
         $generator = new BarcodeGeneratorHTML();
         $barcodes= $generator->getBarcode( $barcodeValue, $generator::TYPE_CODE_128);
            $assets = new Asset();
            $assets->name = $validatedData['name'];
            $assets->category = $validatedData['category'];
            $assets->status = $validatedData['status'];
            $assets->p_price = $validatedData['p_price'];
            $assets->uta =$validatedData['uta'];
            $assets->purchase_date= $validatedData['purchase_date'];
            $assets->manufactured_year= $validatedData['manufactured_year'];
            $assets->asset_code= $asset_code;
            $assets->barcodes= $barcodes;
            $assets->save();
        
        if ($validatedData['category'] === 'ELECTRONIC') {
            Electronic::create([
                'assets_id' => $assets->id,
                'chapa' => $validatedData['chapa'],
                'modeli' => $validatedData['modeli'],
                'serial_no' => $validatedData['serial_no'],
            ]);
        }
        if ($validatedData['category'] === 'FURNITURE') {
            Furniture::create([
                'assets_id' => $assets->id,
                'furniture_type' => $validatedData['furniture_type'],
            ]);
        }
        if ($validatedData['category'] === 'BUILDING') {
            Building::create([
                'assets_id' => $assets->id,
                'size' => $validatedData['size'],
                'purpose' => $validatedData['purpose'],
                'floor_no' => $validatedData['floor_no'],
                'no_of_rooms' => $validatedData['no_of_rooms'],
            ]);
        }
        if ($validatedData['category'] === 'TRANSPORT') {
            Transport::create([
                'assets_id' => $assets->id,
                'transport_type' => $validatedData['transport_type'],
                'cheses_no' => $validatedData['cheses_no'],
                'reg_no' => $validatedData['reg_no'],
                'engine_capacity' => $validatedData['engine_capacity'],
                'brand' => $validatedData['brand'],
                'model' => $validatedData['model'],
            ]);
        }
         return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'Asset created successfully!',
        ]);
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
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Asset Ordered successfully!',
            ]);
        }
    }

    public function show($id){
            $asset= Asset::find($id);
           $electronic=Electronic::where('assets_id',$id)->first();
            $building=Building::where('assets_id',$id)->first();
            $furniture=Furniture::where('assets_id',$id)->first();
            $transport=Transport::where('assets_id',$id)->first();
            $infos = Info::with('user')->select('*')
           ->where('assets_id',$id)
           ->orderBy('created_at', 'desc')
           ->get()
           ->unique('user_id');
        return response()->json(['success'=>true,'status'=>300, 'data'=> $asset,'electronic'=>$electronic,'furniture'=>$furniture,'transport'=>$transport, 'building'=>$building,'info'=>$infos],200); 
    }


    public function assignView($id)
    {
        $assets=Asset::find($id);
     $request=Order::with('user')->where('assets_id',$id)->where('status','1')->first();
     return response()->json(['success'=>true,'status'=>300, 'data'=> $assets,'request'=>$request,],200);   
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
       
       return response()->json([
        'success'=>true,
        'status'=>300,
        'message'=>'Asset Assigned successfully!',
    ]);
    }

    public function unassignView($id)
    {
        $assets=Asset::find($id);
      $staff=User::with('asset')->get(); 
      return response()->json(['success'=>true,'status'=>300, 'data'=> $assets,'staff'=>$staff,],200);
    }

    public function assetUnassign(Request $request ,$id)
    {
        $asset=Asset::find($id);
    $asset_name= $asset->name;
       $issued=IssuedAsset::where('assets_id',$id)->latest()->first();
      $issued_i=IssuedAsset::where('assets_id',$id)->where('status',1)->latest()->first();
      $order=Order::where('assets_id',$id)->first();
        if($asset){
            $asset->user_id = NULL;
            $asset->status =$request->status;
            $asset->flug ='0';
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
            if($asset->update()){
                 $order->delete();
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
                 if($asset->status=='BROKEN')
                 {
                    $maintain=new Maintainance;
                    $maintain->assets_id= $id;
                    $maintain->condtn= $asset->status;
                    $maintain->returned_at= $asset->created_at;
                    $maintain->save();
                 }
             }
        }
        return response()->json([
            'success'=>true,
            'status'=>300,
            'message'=>'Asset Unassigned successfully!',
        ]);
    }

    public function workshop()
    {
        $maintains=Maintainance::with('asset')->where('flug',1)->get();
        $maintainsCount=Maintainance::with('asset')->where('flug',1)->count();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $maintains,'count'=>$maintainsCount],200);
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
                if( $repair->condtn=='DISPOSED'){
                    $disposal=new Disposal;
                    $disposal->assets_id= $rep_id;
                    $disposal->condtn_m="DISPOSED";
                    $disposal->save(); 

                    $disp=$maintains; 
                    $disp->status=$repair->condtn;
                    $disp->control=0;
                    $disp->update();
                    if($disp->update())
                    {
                       $repair->delete();
                    }
                }elseif($repair->condtn=='REPAIRED'){
                   $history=new Repair;
                 $history->assets_id= $rep_id;
                  $history->flug="BROKEN";
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
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Asset Repaired successfully!',
            ]);
        }
    }

    public function disposal()
    {
        $disposal=Disposal::with('asset')->where('flug',1)->get();
        $disposalCount=Disposal::with('asset')->where('flug',1)->count();
        return response()->json(['success'=>true,'status'=>300, 'data'=> $disposal,'count'=>$disposalCount],200);
    }


    public function destroy($id)
    {
            $assets=Asset::find($id);
            $assets->delete();
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Asset Deleted successfully!',
            ]);
    }
}
