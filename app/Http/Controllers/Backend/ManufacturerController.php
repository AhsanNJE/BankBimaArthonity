<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer_Info;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{

    public function InsertManufacturer(Request $request){

        //Validate Manufacturer Details
        $request->validate([
            'manufacturer_name' => 'required',
        ]);
 
 
        //Insert Manufacturer Details
        Manufacturer_Info::insert([
            'manufacturer_name' => $request->manufacturer_name,
        ]);
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowManufacturerList(Request $request){
        $manufacturer = Manufacturer_Info::orderBy('added_at','asc')->paginate(15);
        return view('manufacturer.manufacturers', compact('manufacturer'));

    }

    public function ManufacturerInfo(Request $request){
        $manufacturer = Manufacturer_Info::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('manufacturer.fullDetails', compact('manufacturer'))->render(),
        ]);
    }

    //Edit Manufacturer
    public function EditManufacturer(Request $request){
        $manufacturer = Manufacturer_Info::where('id', $request->id)->first();
        return response()->json([
            'manufacturer'=>$manufacturer,
        ]);
    }//End Method

    //Update Manufacturer
    public function UpdateManufacturer(Request $request){
        
        $request->validate([
            'manufacturer_name' => 'required',
        ]);


        $update = Manufacturer_Info::findOrFail($request->id)->update([
     
            'manufacturer_name' => $request->manufacturer_name,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Manufacturer
    public function DeleteManufacturer(Request $request){
        Manufacturer_Info::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Manufacturer Pagination
    public function ManufacturerPagination(){
        $manufacturer = Manufacturer_Info::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('manufacturer.manufacturerPagination', compact('manufacturer'))->render(),
        ]);
    }//End Method


    // Search Manufacturer by Name
    public function SearchManufacturer(Request $request){
        if($request->search != ""){
            $manufacturer = Manufacturer_Info::where('manufacturer_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('manufacturer_name','asc')
            ->paginate(15);
        }
        else{
            $manufacturer = Manufacturer_Info::orderBy('manufacturer_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $manufacturer->links()->toHtml();
        
        if($manufacturer->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('manufacturer.searchManufacturer', compact('manufacturer'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method


}

