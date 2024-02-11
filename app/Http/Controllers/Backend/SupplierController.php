<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Supplier_Info;

class SupplierController extends Controller
{
    /////////////////////////// --------------- Inventory Suppliers Methods start---------- //////////////////////////
    //Show Suppliers
    public function ShowSuppliers(){
        $supplier = Supplier_Info::orderBy('added_at','desc')->paginate(15);
        return view('supplier.suppliers', compact('supplier'));
    }//End Method



    //Get Suppliers by Name
    public function GetSupplierByName(Request $request){
        if($request->supplier != ""){
            $supplier = Supplier_Info::where('sup_name', 'like', '%'.$request->supplier.'%')
                ->orderBy('sup_name','asc')
                ->take(10)
                ->get();
    
            if($supplier->count() > 0){
                $list = "";
                foreach($supplier as $sup) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$sup->id.'">'.$sup->sup_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
            }
            return $list;
        }else{
            return "";
        } 
    }//End Method



    //Insert Supplier
    public function InsertSuppliers(Request $request){
        $request->validate([
            "supplierName" => 'required|unique:supplier__infos,sup_name',
            "supplierEmail" => 'required|email',
            "supplierContact" => 'required|numeric',
            "supplierAddress" => 'required',
        ]);
        
        Supplier_info::insert([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "sup_address" => $request->supplierAddress,
        ]);

        return response()->json([
            'status'=>'success',
        ]); 
    }//End Method



    //Edit Supplier
    public function EditSuppliers($id){
        $supplier = Supplier_info::findOrFail($id);
        return response()->json([
            'supplier'=>$supplier,
        ]);
    }//End Method



    //Update Supplier
    public function UpdateSuppliers(Request $request,$id){
        $suplier = Supplier_info::findOrFail($id);

        $request->validate([
            "supplierName" => ['required',Rule::unique('supplier__infos', 'sup_name')->ignore($suplier->id)],
            "supplierEmail" => 'required|email',
            "supplierContact" => 'required|numeric',
            "supplierAddress" => 'required',
        ]);

        $update = Supplier_info::findOrFail($id)->update([
            "sup_name" => $request->supplierName,
            "sup_email" => $request->supplierEmail,
            "sup_contact" => $request->supplierContact,
            "sup_address" => $request->supplierAddress,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Supplier
    public function DeleteSuppliers($id){
        Supplier_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Supplier Pagination
    public function SupplierPagination(){
        $supplier = Supplier_Info::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('supplier.supplierPagination', compact('supplier'))->render(),
        ]);
    }//End Method



    //Search Suppplier by Name
    public function SearchSuppliers(Request $request){
        $supplier = Supplier_Info::where('sup_name', 'like','%'.$request->search.'%')
        ->orderBy('sup_name','asc')
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
        $supplier = Supplier_Info::where('sup_email', 'like','%'.$request->search.'%')
        ->orderBy('sup_email','asc')
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
        $supplier = Supplier_Info::where('sup_contact', 'like','%'.$request->search.'%')
        ->orderBy('sup_contact','asc')
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
        $supplier = Supplier_Info::where('sup_address', 'like', '%'.$request->search.'%')
        ->orderBy('sup_address','asc')
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
