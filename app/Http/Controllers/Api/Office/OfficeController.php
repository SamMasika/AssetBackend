<?php

namespace App\Http\Controllers\Api\Office;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
        public function index()
        {
            // $departments=Department::where('flug',1)->get();
              $offices=Office::with('department')->where('flug',1)->get();
              $officeCount = Office::where('flug',1)->count();
                return response()->json(['success'=>true,'status'=>300, 'data'=> $offices ,'count'=> $officeCount],200); 
        }
      
        public function store(Request $request)
        {
           $offices=Office::create( $request->all());
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Office created successfully!',
            ]);
        }
    
        public function show($id)
        {
            $office= Office::find($id);
           if( $office){
            return response()->json(['success'=>true,'status'=>300, 'data'=> 
            $office],200); 
           }else{
            return response()->json(['success'=>false,'status'=>404,'message'=> 'No Office of that ID']);
           }
           
        }
     
        public function update(Request $request, $id)
        {
            $office=Office::find($id);
            $office->update($request->all());
                return response()->json([
                    'success'=>true,'status'=>300,  'message'=>'Office Updated successfully!'
                ]);
        }
        
        public function destroy($id)
        {
            $offices=Office::find($id);
            if($offices){
                $offices->delete();
                return response()->json(['success'=>true, 'status'=>null, 'message'=>'Office deleted successfully!']);
            }else{
                return response()->json(['success'=>false,'status'=>404,'message'=>'No Office to be deleted!!']); 
            }
        }
    
}
