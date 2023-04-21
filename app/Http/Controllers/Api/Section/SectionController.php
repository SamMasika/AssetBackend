<?php

namespace App\Http\Controllers\Api\Section;

use App\Models\Department;
use App\Models\IssuedAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
        {
           $sections=Department::where('flug',1)->get();
           $count=Department::where('flug',1)->count();
               return response()->json(['success'=>true,'status'=>300, 'data'=> $sections ,'count'=>$count],200); 
        }
      
        public function store(Request $request)
        {
           $sections=Department::create( $request->all());
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Section created successfully!',
            ]);
        }
    
        public function show($id)
    {
        $depart=Department::find($id);
     $assetAssigned=IssuedAsset::join('departments','departments.id','=','issued_assets.depart_id')
                                     ->join('users','departments.id','=','users.depart_id')
                                   -> where('issued_assets.depart_id',$id)
                                   -> where('issued_assets.status',1)
                                   ->count();
    $issued=IssuedAsset::with('user')->with('asset')->where('depart_id',$id)->where('status',1)->get();
    return response()->json(['success'=>true,'status'=>300, 'data'=> $depart,'issued'=>$issued,'assetAssigned'=>$assetAssigned, ],200);
    }
     
        public function update(Request $request, $id)
        {
            $section=Department::find($id);
            $section->update($request->all());
        
                return response()->json([
                    'success'=>true,'status'=>300,  'message'=>'Section Updated successfully!'
                ]);
             
           
        }
        
        public function destroy($id)
        {
            $sections=Department::find($id);
                $sections->delete();
                return response()->json(['success'=>true, 'status'=>null, 'message'=>'Section deleted successfully!']); 
        }
}
