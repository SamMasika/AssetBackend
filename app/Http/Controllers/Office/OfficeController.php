<?php

namespace App\Http\Controllers\Office;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    public function index()
    {
        $offices=Office::where('flug',1)->get();
        return view('asset.office.index',compact('offices'));
    }

    public function show($id)
    {
        $depart=Office::find($id);
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
        $offices=Office::where('flug',1)->get();
        return $pdf->download('departments.pdf');  
    }
    public function store(Request $request)
    {
        $offices = Office::create($request->all());
         return redirect()->back()->with('status','Office added successfully!');

    }
   
    public function update(Request $request, $id)
    {
        $offices=Office::find($id)->update($request->all());
        return redirect()->back()->with('status','Section updated successfully!');
    }

    public function destroy($id)
    {
        $offices=Office::find($id);
        $offices->flug=0;
        $offices->update();
        return redirect()->back()->with('status','Section deleted successfully!');
       
    }
}
