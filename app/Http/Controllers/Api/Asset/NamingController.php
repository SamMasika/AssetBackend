<?php

namespace App\Http\Controllers\Api\Asset;

use App\Models\Naming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NamingController extends Controller
{
    public function index()
        {
           $names=Naming::where('flug',1)->get();
               return response()->json(['success'=>true,'status'=>300, 'data'=> $names ],200); 
        }
      
        public function store(Request $request)
        {
           $names=Naming::create( $request->all());
            return response()->json([
                'success'=>true,
                'status'=>300,
                'message'=>'Name created successfully!',
            ]);
        }
    
        public function show($id)
        {
            $name= Naming::find($id);
           if( $name){
            return response()->json(['success'=>true,'status'=>300, 'data'=> 
            $name],200); 
           }else{
            return response()->json(['success'=>false,'status'=>404,'message'=> 'No Name of that ID']);
           }
           
        }
     
        public function update(Request $request, $id)
        {
            $name=Naming::find($id);
            $name->update($request->all());
        
                return response()->json([
                    'success'=>true,'status'=>300,  'message'=>'Name Updated successfully!'
                ]);
             
           
        }
        
        public function destroy($id)
        {
            $names=Naming::find($id);
                $names->delete();
                return response()->json(['success'=>true, 'status'=>null, 'message'=>'Name deleted successfully!']); 
        }
}
