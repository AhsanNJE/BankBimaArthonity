<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Type;
use App\Models\Transaction_With;
use App\Models\Transaction_With_Groupe;
use App\Models\Transaction_Groupe;
use App\Models\Transaction_Head;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Main;
use App\Models\User_Info;
use App\Models\Party_Payment_Receive;
use App\Models\Store;
use App\Models\Category_Name;
use App\Models\Manufacturer_Info;
use App\Models\Item_Form;
use App\Models\Item_Unite;

class InventoryController extends Controller
{

    /////////////////////////// --------------- Form Methods start ---------- //////////////////////////


    public function InsertForm(Request $request){

        //Validate Form Details
        $request->validate([
            'form_name' => 'required',
        ]);
 
 
        //Insert Form Details
        Item_Form::insert([
            'form_name' => $request->form_name,
        ]);
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowFormList(Request $request){
        $form = Item_Form::orderBy('added_at','asc')->paginate(15);
        return view('form.forms', compact('form'));

    }


    //Edit Form
    public function EditForm(Request $request){
        $form = Item_Form::where('id', $request->id)->first();
        return response()->json([
            'form'=>$form,
        ]);
    }//End Method

    //Update Form
    public function UpdateForm(Request $request){
        
        $request->validate([
            'form_name' => 'required',
        ]);


        $update = Item_Form::findOrFail($request->id)->update([
     
            'form_name' => $request->form_name,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Form
    public function DeleteForm(Request $request){
        Item_Form::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Form Pagination
    public function FormPagination(){
        $form = Item_Form::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('form.formPagination', compact('form'))->render(),
        ]);
    }//End Method


    // Search Form by Name
    public function SearchForm(Request $request){
        if($request->search != ""){
            $form = Item_Form::where('form_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('form_name','asc')
            ->paginate(15);
        }
        else{
            $form = Item_Form::orderBy('form_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $form->links()->toHtml();
        
        if($form->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('form.searchForm', compact('form'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method





    /////////////////////////// --------------- Unit Methods start ---------- //////////////////////////


    public function InsertUnit(Request $request){

        //Validate Form Details
        $request->validate([
            'unit_name' => 'required',
        ]);
 
 
        //Insert Form Details
        Item_Unit::insert([
            'unit_name' => $request->unit_name,
        ]);
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowUnitList(Request $request){
        $unit = Item_Unit::orderBy('added_at','asc')->paginate(15);
        return view('unit.units', compact('unit'));

    }

    //Edit Form
    public function EditUnit(Request $request){
        $unit = Item_Unit::where('id', $request->id)->first();
        return response()->json([
            'unit'=>$unit,
        ]);
    }//End Method

    //Update Form
    public function UpdateUnit(Request $request){
        
        $request->validate([
            'unit_name' => 'required',
        ]);


        $update = Item_Unit::findOrFail($request->id)->update([
     
            'unit_name' => $request->unit_name,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Form
    public function DeleteUnit(Request $request){
        Item_Unit::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Form Pagination
    public function UnitPagination(){
        $unit = Item_Unit::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('unit.unitPagination', compact('unit'))->render(),
        ]);
    }//End Method


    // Search Form by Name
    public function SearchUnit(Request $request){
        if($request->search != ""){
            $unit = Item_Unit::where('unit_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('unit_name','asc')
            ->paginate(15);
        }
        else{
            $unit = Item_Unit::orderBy('unit_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $unit->links()->toHtml();
        
        if($unit->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('unit.searchUnit', compact('unit'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method






    /////////////////////////// --------------- Inventory Purchase Methods start ---------- //////////////////////////
    // Show All Purchase Details
    public function ShowInventoryPurchase(){
        $inventory = Transaction_Main::where('tran_method','Payment')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.purchase.inventoryPurchase', compact('inventory','groupes'));
    }//End Method




    /////////////////////////// --------------- Inventory Purchase Methods Ends ---------- //////////////////////////
    





    /////////////////////////// --------------- Inventory Issue Methods start ---------- //////////////////////////
    // Show All Issue Details
    public function ShowInventoryIssue(){
        $inventory = Transaction_Main::where('tran_method','Receive')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.issue.inventoryIssue', compact('inventory','groupes'));
    }//End Method


    //Insert Inventory Issue
    public function InsertInventoryIssue(Request $req){
        $req->validate([
            "tranId" => 'required',
            "method" => 'required',
            "location" => 'required|numeric',
            "type" => 'required',
            "groupe" => 'required',
            "head" => 'required',
            "with" => 'required',
            "user" => 'required',
            "amount" => 'required',
            "quantity" => 'required',
            "totAmount" => 'required',
        ]);

        if($req->head != null){
            $product = Transaction_Detail::where('tran_head_id', $req->head)
            ->where('quantity', '>', 0)
            ->where('tran_method', "Payment")
            ->orderBy('tran_date', 'asc')
            ->get();

            $transaction = Transaction_Detail::where('tran_id', $req->tranId)
            ->where('tran_head_id', $req->head)
            ->get();

            if($transaction->count() > 0){
                return response()->json([
                    'errors' => [
                        'head' => ["You have already add this item."]
                    ]
                ], 422);
            }
            else if($product->count() > 0){
                $quantity = $req->quantity;
                $totQuantity = 0;
                foreach($product as $index => $pro) {
                    $totQuantity = $totQuantity + $pro->quantity;
                }

                if($quantity > 0){
                    if($totQuantity < $quantity){
                        return response()->json([
                            'errors' => [
                                'quantity' => ['Only '. $totQuantity . 'product available in stock']
                            ]
                        ], 422);
                    }
                    else{
                        foreach($product as $index => $pro) {
                            if($quantity != 0){
                                if($pro->quantity <= $quantity){
                                    $issue =  $pro->quantity_issue + $pro->quantity ;
                                    Transaction_Detail::findOrFail($pro->id)->update([
                                        "quantity_issue" => $issue,
                                        "quantity" => 0,
                                        "updated_at" => now()
                                    ]);

                                    $quantity = $quantity - $pro->quantity;
                                }
                                else if($pro->quantity > $quantity){
                                    $issue =  $pro->quantity_issue + $quantity ;
                                    $dueQuantity = $pro->quantity - $quantity;
                                    Transaction_Detail::findOrFail($pro->id)->update([
                                        "quantity_issue" => $issue,
                                        "quantity" => $dueQuantity,
                                        "updated_at" => now()
                                    ]);

                                    Transaction_Detail::insert([
                                        "tran_id" => $req->tranId,
                                        "loc_id" => $req->location,
                                        "tran_type" => $req->type,
                                        "tran_method" => $req->method,
                                        "tran_groupe_id" => $req->groupe,
                                        "tran_head_id" => $req->head,
                                        "tran_type_with" => $req->with,
                                        "tran_user" => $req->user,
                                        "amount" => $req->amount,
                                        "quantity" => $req->quantity,
                                        "tot_amount" => $req->totAmount,
                                    ]);

                                    $quantity = 0;
                                }
                            }
                        }
    
                        return response()->json([
                            'status'=>'success',
                        ]); 
                    }
                }
            }
            else{
                return response()->json([
                    'errors' => [
                        'head' => ['Product Stock out']
                    ]
                ], 422);
            }
        }
    }//End Method




    // Inventory Issue Pagination
    public function InventoryIssuePagination(Request $req){
        $inventory = Transaction_Main::where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        return view('inventory.issue.inventoryIssuePagination', compact('inventory'));
    }//End Method



    // Get Inventory Issue by Date Range
    public function ShowInventoryIssueByDate(Request $req){
        $inventory = Transaction_Main::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method', $req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $inventory->links()->toHtml();

        
        if($inventory->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.issue.search', compact('inventory'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Get Inventory Issue by TranId
    public function SearchInventoryIssueByTranId(Request $req){
        $inventory = Transaction_Main::where('tran_id', "like", '%'. $req->search .'%')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_id','asc')
        ->paginate(15);
        
        $paginationHtml = $inventory->links()->toHtml();
        
        if($inventory->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.issue.search', compact('inventory'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    
    // Get Inventory Issue by Tran User
    public function SearchInventoryIssueByTranUser(Request $req){
        $inventory = Transaction_Main::with('User')
        ->whereHas('User', function ($query) use ($req) {
            $query->where('user_name', 'like', '%'.$req->search.'%');
            $query->orderBy('user_name','asc');
        })
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->paginate(15);
        

        $paginationHtml = $inventory->links()->toHtml();

        if($inventory->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('inventory.issue.search', compact('inventory'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method

    /////////////////////////// --------------- Inventory Issue Methods Ends ---------- //////////////////////////
    




    /////////////////////////// --------------- Inventory Return Methods start ---------- //////////////////////////
    // Show All Return Details
    public function ShowInventoryReturn(){
        $inventory = Transaction_Main::where('tran_method','Payment')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.return.inventoryReturn', compact('inventory','groupes'));
    }//End Method

    /////////////////////////// --------------- Inventory Return Methods Ends ---------- //////////////////////////
    
    


     /////////////////////////// --------------- Inventory Store Methods start ---------- //////////////////////////
    

    public function InsertStore(Request $request){

        //Validate Store Details
        $request->validate([
            'store_name' => 'required',
            'division' => 'required',
            'location' => 'required',
        ]);
 
 
        //Insert Store Details
        Store::insert([
            'store_name' => $request->store_name,
            'division' => $request->division,
            'location_id' => $request->location,
        ]);
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowStoreList(Request $request){
        $store = Store::orderBy('added_at','asc')->paginate(15);
        return view('store.stores', compact('store'));
    }


    //Edit Store
    public function EditStore(Request $request){
        $store = Store::with('Location')->where('id', $request->id)->first();
        return response()->json([
            'store'=>$store,
        ]);
    }//End Method

    //Update Store
    public function UpdateStore(Request $request){
        
        $request->validate([
            'store_name' => 'required',
            'division' => 'required',
            'location' => 'required',
        ]);


        $update = Store::findOrFail($request->id)->update([
     
            'store_name' => $request->store_name,
            'division' => $request->division,
            'location_id' => $request->location,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Store
    public function DeleteStore(Request $request){
        Store::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Store Pagination
    public function StorePagination(){
        $store = Store::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('store.storePagination', compact('store'))->render(),
        ]);
    }//End Method


    // Search Store by Name
    public function SearchStore(Request $request){
        if($request->search != ""){
            $store = Store::where('store_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('store_name','asc')
            ->paginate(15);
        }
        else{
            $store = Store::orderBy('store_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $store->links()->toHtml();
        
        if($store->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('store.searchStore', compact('store'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    /////////////////////////// --------------- Pharmacy Product Table Methods start ---------- //////////////////////////
    //Show All Pharmacy Product
    public function ShowPharmacyProduct(){
        // $unites = Item_Unite::orderBy('added_at','asc')->get();
        // $itemforms = Item_Form::orderBy('added_at','asc')->get();
        // $manufactures = Manufacturer_Info::orderBy('added_at','asc')->get();
        // $categorys = Category_Name::orderBy('added_at','asc')->get();
        // $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        // $heads = Transaction_Head::orderBy('added_at','asc')->paginate(15);
        return view('pharmacy_product.addPharmacyProduct');
    }//End Method





    /////////////////////////// --------------- Inventory Store Methods start ---------- //////////////////////////
    

    

    public function ShowProductList(Request $request){
        $product = Product::with('Heads','Manufacturers','Categories')->orderBy('added_at','asc')->paginate(15);
        return view('product.products', compact('product'));
    }


    //Edit Store
    public function EditProduct(Request $request){
        $product = Product::with('Location')->where('id', $request->id)->first();
        return response()->json([
            'product'=>$product,
        ]);
    }//End Method

    //Update Store
    public function UpdateProduct(Request $request){
        
        $request->validate([
            'store_name' => 'required',
            'division' => 'required',
            'location' => 'required',
        ]);


        $update = Store::findOrFail($request->id)->update([
     
            'store_name' => $request->store_name,
            'division' => $request->division,
            'location_id' => $request->location,
            "updated_at" => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Store
    public function DeleteProduct(Request $request){
        Store::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    //Store Pagination
    public function ProductPagination(){
        $product = Store::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('store.storePagination', compact('store'))->render(),
        ]);
    }//End Method


    // Search Store by Name
    public function SearchProduct(Request $request){
        if($request->search != ""){
            $store = Store::where('store_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('store_name','asc')
            ->paginate(15);
        }
        else{
            $store = Store::orderBy('store_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $store->links()->toHtml();
        
        if($store->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('store.searchStore', compact('store'))->render(),
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
