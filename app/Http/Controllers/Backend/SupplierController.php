<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Supplier_Info;
use App\Models\User_Info;

class SupplierController extends Controller
{
    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////
    //Show Suppliers
    public function ShowSuppliers(){
        $supplier = User_Info::where('user_type','supplier')->orderBy('added_at','desc')->paginate(15);
        return view('supplier.suppliers', compact('supplier'));
    }//End Method



    //Get Suppliers by Name
    public function GetSupplierByName(Request $request){
        if($request->supplier != ""){
            $supplier = User_Info::where('user_name', 'like', '%'.$request->supplier.'%')
                ->orderBy('user_name','asc')
                ->take(10)
                ->get();
    
            if($supplier->count() > 0){
                $list = "";
                foreach($supplier as $index => $sup) {
                    $list .= '<li tabindex="'.($index + 1).'" data-id="'.$sup->id.'">'.$sup->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method



    //Insert Supplier
    public function InsertSuppliers(Request $req){
        $req->validate([
            "name" => 'required',
            "type" => 'required',
            "email" => 'required|email|unique:user__infos,user_email',
            "phone" => 'required|numeric|unique:user__infos,user_phone',
            "location" => 'required',
            "address" => 'required',
        ]);


        //generates Auto Increment Client Id
        $latestEmployee = User_Info::where('user_type','supplier')->orderBy('added_at','desc')->first();
        $id = ($latestEmployee) ? 'S' . str_pad((intval(substr($latestEmployee->user_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'S000000101';

        
        User_Info::insert([
            "user_id" => $id,
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_email" => $req->email,
            "user_phone" => $req->phone,
            "loc_id" => $req->location,
            "address" => $req->address,
            "user_type" => 'supplier',
        ]);

        return response()->json([
            'status'=>'success',
        ]); 
    }//End Method



    //Edit Supplier
    public function EditSuppliers(Request $req){
        $supplier = User_Info::with('Location')->findOrFail($req->id);
        return response()->json([
            'supplier'=>$supplier,
        ]);
    }//End Method



    //Update Supplier
    public function UpdateSuppliers(Request $req){
        $supplier = User_Info::findOrFail($req->id);

        $req->validate([
            "name" => 'required',
            "email" => ['required','email',Rule::unique('user__infos', 'user_email')->ignore($supplier->id)],
            "phone" => ['required','numeric',Rule::unique('user__infos', 'user_phone')->ignore($supplier->id)],
            "address" => 'required',
            "location" => 'required',
            "type" => 'required'
        ]);

        $update = User_Info::findOrFail($req->id)->update([
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_email" => $req->email,
            "user_phone" => $req->phone,
            "loc_id" => $req->location,
            "address" => $req->address,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Supplier
    public function DeleteSuppliers(Request $req){
        User_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Supplier Pagination
    public function SupplierPagination(){
        $supplier = User_Info::where('user_type','supplier')->orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('supplier.supplierPagination', compact('supplier'))->render(),
        ]);
    }//End Method



    //Search Suppplier by Name
    public function SearchSuppliers(Request $request){
        $supplier = User_Info::where('user_type','supplier')
        ->where('user_name', 'like','%'.$request->search.'%')
        ->orderBy('user_name','asc')
        ->paginate(15);

        $paginationHtml = $supplier->links()->toHtml();
        
        if($supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('supplier.searchSupplier', compact('supplier'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Email
    public function SearchSupplierByEmail(Request $request){
        $supplier = User_Info::where('user_type','supplier')
        ->where('user_email', 'like','%'.$request->search.'%')
        ->orderBy('user_email','asc')
        ->paginate(15);

        $paginationHtml = $supplier->links()->toHtml();
        
        if($supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('supplier.searchSupplier', compact('supplier'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Contact
    public function SearchSupplierByContact(Request $request){
        $supplier = User_Info::where('user_type','supplier')
        ->where('user_phone', 'like','%'.$request->search.'%')
        ->orderBy('user_phone','asc')
        ->paginate(15);

        $paginationHtml = $supplier->links()->toHtml();
        
        if($supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('supplier.searchSupplier', compact('supplier'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Location
    public function SearchSupplierByLocation(Request $request){
        $supplier = User_Info::with('Location')
        ->whereHas('Location', function ($query) use ($request) {
            $query->where('thana', 'like', '%'.$request->search.'%');
            $query->orderBy('thana','asc');
        })
        ->where('user_type','supplier')
        ->paginate(15);

        $paginationHtml = $supplier->links()->toHtml();
        
        if($supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('supplier.searchSupplier', compact('supplier'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Suppplier by Address
    public function SearchSupplierByAddress(Request $request){
        $supplier = User_Info::where('user_type','supplier')
        ->where('address', 'like', '%'.$request->search.'%')
        ->orderBy('address','asc')
        ->paginate(15);

        $paginationHtml = $supplier->links()->toHtml();
        
        if($supplier->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('supplier.searchSupplier', compact('supplier'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method

    /////////////////////////// --------------- Suppliers Methods start---------- //////////////////////////
}
