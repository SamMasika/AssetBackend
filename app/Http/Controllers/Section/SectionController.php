<?php

namespace App\Http\Controllers\Section;

use App\Models\Department;
use App\Models\IssuedAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
    {
        $sections=Department::where('flug',1)->get();
        return view('asset.section.index',compact('sections'));
    }

    public function show($id)
    {
        $depart=Department::find($id);
     $department=IssuedAsset::join('departments','departments.id','=','issued_assets.depart_id')
                                     ->join('users','departments.id','=','users.depart_id')
                                   -> where('issued_assets.depart_id',$id)
                                   -> where('issued_assets.status',1)
                                   ->count();
    $issued=IssuedAsset::with('user')->with('asset')->where('depart_id',$id)->where('status',1)->get();
       return view('asset.section.view',compact('depart','issued'));
    }
   
    public function downloadPDF()
    {
        $departments=Department::where('flug',1)->get();
        return $pdf->download('departments.pdf');  
    }
    public function store(Request $request)
    {
        $departments = Department::create($request->all());
         return redirect()->back()->with('status','Section added successfully!');

    }
   
    public function update(Request $request, $id)
    {
        $departments=Department::find($id)->update($request->all());
        return redirect()->back()->with('status','Section updated successfully!');
    }

    public function destroy($id)
    {
        $departments=Department::find($id);
        $departments->flug=0;
        $departments->update();
        return redirect()->back()->with('status','Section deleted successfully!');
       
    }
}
