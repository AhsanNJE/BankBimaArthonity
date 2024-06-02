<?php

namespace App\Http\Controllers\Backend;

use App\Models\Store;
use App\Models\Product;
use App\Models\Item_Form;
use App\Models\Item_Unit;
use App\Models\User_Info;
use Illuminate\Http\Request;
use App\Models\Category_Name;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Head;
use App\Models\Transaction_Main;
use App\Models\Transaction_Type;
use App\Models\Transaction_With;
use App\Models\Manufacturer_Info;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Groupe;
use App\Http\Controllers\Controller;
use App\Models\Party_Payment_Receive;

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


    //Get Form By Name
    public function GetFormByName(Request $req){
        $forms = Item_Form::where('form_name', 'like', '%'.$req->form.'%')
        ->orderBy('form_name','asc')
        ->take(10)
        ->get();


        if($forms->count() > 0){
            $list = "";
            foreach($forms as $index => $form) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$form->id.'">'.$form->form_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
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


    //Get Unit By Name
    public function GetUnitByName(Request $req){
        $units = Item_Unit::where('unit_name', 'like', '%'.$req->unit.'%')
        ->orderBy('unit_name','asc')
        ->take(10)
        ->get();


        if($units->count() > 0){
            $list = "";
            foreach($units as $index => $unit) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$unit->id.'">'.$unit->unit_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    }//End Method






    /////////////////////////// --------------- Inventory Purchase Methods start ---------- //////////////////////////
    // Show All Purchase Details
    public function ShowInventoryPurchase(){
        $inventory = Transaction_Main::where('tran_method','Purchase')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.purchase.inventoryPurchase', compact('inventory','groupes'));
    }//End Method'


    //Insert Transaction Details
    public function InsertInventoryPurchase(Request $req){
        $req->validate([
            "tranId" => 'required',
            "method" => 'required',
            "type" => 'required',
            "groupe" => 'required',
            "product" => 'required',
            "with" => 'required',
            "user" => 'required',
            "cp" => 'required',
            "quantity" => 'required',
            "unit" => 'required',
            "totAmount" => 'required',
            "mrp" => 'required',
            "store" => 'required'
        ]);

        // Check If Product is Already entered into this transaction or not 
        $transaction = Transaction_Detail::where('tran_id', $req->tranId)
        ->where('tran_head_id', $req->product)
        ->first();

        if($transaction){
            // Find the Product and Update the Quantity in Product Table
            $products = Transaction_Head::where('id', $req->product)->first();
            $quantity = $products->quantity + $req->quantity - $transaction->quantity;
            Transaction_Head::findOrFail($req->product)->update([
                "quantity" => $quantity,
                "cost_price" => $req->cp,
                "mrp" => $req->mrp,
                "expired_date" => $req->expiry,
                "updated_at" => now()
            ]);


            Transaction_Detail::findOrFail($transaction->id)->update([
                "tran_groupe_id" => $req->groupe,
                "tran_head_id" => $req->product,
                "quantity" => $req->quantity,
                "unit_id" => $req->unit,
                "amount" => $req->cp,
                "mrp" => $req->mrp,
                "tot_amount" => $req->totAmount,
                "expiry_date" => $req->expiry,
                "updated_at" => now()
            ]);

            return response()->json([
                'status'=>'success',
            ]);
        }
        else{
            $heads = Transaction_Head::where('id',$req->product)->first();

            $quantity = $heads->quantity + $req->quantity;
            Transaction_Head::findOrFail($req->product)->update([
                "quantity" => $quantity,
                "cost_price" => $req->cp,
                "mrp" => $req->mrp,
                "expired_date" => $req->expiry,
                "updated_at" => now()
            ]);


            Transaction_Detail::insert([
                "tran_id" => $req->tranId,
                "loc_id" => $req->location,
                "tran_type" => $req->type,
                "tran_method" => $req->method,
                "tran_groupe_id" => $req->groupe,
                "tran_head_id" => $req->product,
                "tran_type_with" => $req->with,
                "tran_user" => $req->user,
                "amount" => $req->cp,
                "quantity" => $req->quantity,
                "unit_id" => $req->unit,
                "tot_amount" => $req->totAmount,
                "mrp" => $req->mrp,
                "expiry_date" => $req->expiry == null ? null :$req->expiry,
                "store_id" => $req->store
            ]);
    
            return response()->json([
                'status'=>'success',
            ]);
        }
    }//End Method



    //Insert Transaction Main
    public function InsertInventoryTransactionMain(Request $req){
        $req->validate([
            "tranId" => 'required|unique:transaction__mains,tran_id',
            "method" => 'required',
            "type" => 'required',
            "withs" => 'required',
            "user" => 'required',
            "amountRP" => 'required',
            "discount" => 'required',
            "netAmount" => 'required',
            "advance" => 'required',
            "balance" => 'required',
            "store" => 'required'
        ]);


        if($req->discount > $req->amountRP){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be bigger than total amount"]
                ]
            ], 422);
        }
        if($req->discount < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  < 0){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be negative"]
                ]
            ], 422);
        }
        else if($req->advance  > $req->netAmount){
            return response()->json([
                'errors' => [
                    'message' => ["Advance amount can't be bigger than Net amount"]
                ]
            ], 422);
        }
        
        
        Transaction_Main::insert([
            "tran_id" => $req->tranId,
            "tran_type" => $req->type,
            "tran_method" => $req->method,
            "tran_type_with" => $req->withs,
            "tran_user" => $req->user,
            "loc_id" => $req->locations,
            "bill_amount" => $req->amountRP,
            "discount" => $req->discount,
            "net_amount" => $req->netAmount,
            "payment" => $req->advance,
            "due" => $req->balance,
            "store_id" => $req->store
        ]);

        return response()->json(['status' => 'success']);
    }//End Method

    /////////////////////////// --------------- Inventory Purchase Methods Ends ---------- //////////////////////////
    





    /////////////////////////// --------------- Inventory Issue Methods start ---------- //////////////////////////
    // Show All Issue Details
    public function ShowInventoryIssue(){
        $inventory = Transaction_Main::where('tran_method','Issue')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.issue.inventoryIssue', compact('inventory','groupes'));
    }//End Method


    //Insert Inventory Issue
    public function InsertInventoryIssue(Request $req){
        $req->validate([
            "tranId" => 'required',
            "method" => 'required',
            "store" => 'required|numeric',
            "type" => 'required',
            "groupe" => 'required',
            "product" => 'required',
            "with" => 'required',
            "user" => 'required',
            "mrp" => 'required',
            "quantity" => 'required',
            "totAmount" => 'required',
        ]);

        if($req->product != null){
            $product = Transaction_Detail::where('tran_head_id', $req->product)
            ->where('quantity', '>', 0)
            ->whereIn('tran_method', ["Purchase","Positive"])
            ->orderBy('tran_date', 'asc')
            ->get();

            $transaction = Transaction_Detail::where('tran_id', $req->tranId)
            ->where('tran_head_id', $req->product)
            ->get();

            if($transaction->count() > 0){
                return response()->json([
                    'errors' => [
                        'product' => ["You have already add this item."]
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
                                    $total = $pro->quantity * $req->mrp;
                                    Transaction_Detail::findOrFail($pro->id)->update([
                                        "quantity_issue" => $issue,
                                        "quantity" => 0,
                                        "updated_at" => now()
                                    ]);


                                    Transaction_Detail::insert([
                                        "tran_id" => $req->tranId,
                                        "store_id" => $req->store,
                                        "tran_type" => $req->type,
                                        "tran_method" => $req->method,
                                        "tran_groupe_id" => $req->groupe,
                                        "tran_head_id" => $req->product,
                                        "tran_type_with" => $req->with,
                                        "tran_user" => $req->user,
                                        "amount" => $req->mrp,
                                        "quantity" => $pro->quantity,
                                        "tot_amount" => $total,
                                        "batch_id" => $pro->tran_id,
                                    ]);

                                    $quantity = $quantity - $pro->quantity;
                                }
                                else if($pro->quantity > $quantity){
                                    $issue =  $pro->quantity_issue + $quantity ;
                                    $dueQuantity = $pro->quantity - $quantity;

                                    $total = $quantity * $req->mrp;
                                    Transaction_Detail::findOrFail($pro->id)->update([
                                        "quantity_issue" => $issue,
                                        "quantity" => $dueQuantity,
                                        "updated_at" => now()
                                    ]);

                                    Transaction_Detail::insert([
                                        "tran_id" => $req->tranId,
                                        "store_id" => $req->store,
                                        "tran_type" => $req->type,
                                        "tran_method" => $req->method,
                                        "tran_groupe_id" => $req->groupe,
                                        "tran_head_id" => $req->product,
                                        "tran_type_with" => $req->with,
                                        "tran_user" => $req->user,
                                        "amount" => $req->mrp,
                                        "quantity" => $quantity,
                                        "tot_amount" => $total,
                                        "batch_id" => $pro->tran_id,
                                    ]);



                                    $quantity = 0;
                                }
                            }
                        }


                        $heads = Transaction_Head::where('id',$req->product)->first();
                        $remain_quantity = $heads->quantity - $req->quantity;
                        Transaction_Head::findOrFail($req->product)->update([
                            "quantity" => $remain_quantity
                        ]);
    
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

    //Get Store By Name
    public function GetStoreByName(Request $req){
        $stores = Store::where('store_name', 'like', '%'.$req->store.'%')
        ->orderBy('store_name','asc')
        ->take(10)
        ->get();


        if($stores->count() > 0){
            $list = "";
            foreach($stores as $index => $store) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$store->id.'">'.$store->store_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    }//End Method




    /////////////////////////// --------------- Pharmacy Product Table Methods START ---------- //////////////////////////
    
    //Show All Pharmacy Product
    public function ShowPharmacyProduct(){
        $groupes = Transaction_Groupe::where('tran_groupe_type', '6')->orderBy('added_at','asc')->get();
        $heads = Transaction_Head::where('groupe_id', 5)->orderBy('added_at','asc')->paginate(15);
        return view('pharmacy_product.pharmacyProduct',compact('groupes', 'heads'));
    }//End Method



     //Get Transaction Heads By Name And Groupe
     public function GetTransactionHeadByGroupe(Request $req){
        if($req->groupein == "1"){
            $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->head.'%')
            ->whereIn('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->take(10)
            ->get();


            if($heads->count() > 0){
                $list = "";
                foreach($heads as $index => $head) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$head->id.'" data-groupe="'.$head->groupe_id.'">'.$head->tran_head_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else{
            $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->head.'%')
            ->where('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->take(10)
            ->get();


            if($heads->count() > 0){
                $list = "";
                foreach($heads as $index => $head) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$head->id.'" data-groupe="'.$head->groupe_id.'">'.$head->tran_head_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
    }//End Method



    //Insert Pharmacy Product
    public function InsertPharmacyProduct(Request $req){
        $req->validate([
            "headName" => 'required',
            "groupe" => 'required|numeric',
            "category" => 'required|numeric',
            "manufacturer" => 'required|numeric',
            "form" => 'required|numeric',
            "unit" => 'required|numeric',
            "store" => 'required|numeric',
            "expireddate" => 'required',
        ]);

        Transaction_Head::insert([
            "tran_head_name" => $req->headName,
            "groupe_id" => $req->groupe,
            "category_id" => $req->category,
            "manufacture_id" => $req->manufacturer,
            "item_form_id" => $req->form,
            "item_unite_id" => $req->unit,
            "store_id" => $req->store,
            "expired_date" => $req->expireddate,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  

    }//End Method

    //Edit Pharmacy Product
    public function EditPharmacyProduct(Request $req){
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        $heads = Transaction_Head::with('Groupe', 'Category', 'Manufecture', 'ItemForm', 'ItemUnit', 'Store')->findOrFail($req->id);
        return response()->json([
            'heads'=>$heads,
            'groupes' => $groupes,
        ]);
    }//End Method

    //Update Pharmacy Product
    public function UpdatePharmacyProduct(Request $req){

        $heads = Transaction_Head::findOrFail($req->id);

        $req->validate([
            "headName" => 'required',
            "groupe" => 'required|numeric',
            "category" => 'required|numeric',
            "manufacturer" => 'required|numeric',
            "form" => 'required|numeric',
            "unit" => 'required|numeric',
            "store" => 'required|numeric',
            "quantity" => 'required|numeric',
            "costprice" => 'required|numeric',
            "mrp" => 'required|numeric',
            "expireddate" => 'required',
        ]);

        $update = Transaction_Head::findOrFail($req->id)->update([
            "tran_head_name" => $req->headName,
            "groupe_id" => $req->groupe,
            "category_id" => $req->category,
            "manufacture_id" => $req->manufacturer,
            "item_form_id" => $req->form,
            "item_unite_id" => $req->unit,
            "store_id" => $req->store,
            "quantity" => $req->quantity,
            "cost_price" => $req->costprice,
            "mrp" => $req->mrp,
            "expired_date" => $req->expireddate,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


     //Delete Pharmacy Product -----------> Using Method Re-use for Transaction Head Ajax Part---//


    //Pharmacy Product Pagination
    public function PharmacyProductPagination(){
        $heads = Transaction_Head::where('groupe_id', 5)->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('pharmacy_product.pharmacyProductPagination', compact('heads'))->render(),
        ]);
    }//End Method

    //Pharmacy Product Search
    public function SearchPharmacyProduct(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->where('tran_head_name', 'like', '%'.$req->search.'%')
        ->orderBy('tran_head_name','asc')
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By Groupe
    public function SearchPharmacyProductGroupe(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('Groupe')
        ->whereHas('Groupe', function ($query) use ($req) {
            $query->where('tran_groupe_name', 'like', '%' . $req->search . '%');
            $query->orderBy('tran_groupe_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By Category
    public function SearchPharmacyProductCategory(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('Category')
        ->whereHas('Category', function ($query) use ($req) {
            $query->where('category_name', 'like', '%' . $req->search . '%');
            $query->orderBy('category_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By Manufacture
    public function SearchPharmacyProductManufacture(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('Manufecture')
        ->whereHas('Manufecture', function ($query) use ($req) {
            $query->where('manufacturer_name', 'like', '%' . $req->search . '%');
            $query->orderBy('manufacturer_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By Item Form
    public function SearchPharmacyProductItemForm(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('ItemForm')
        ->whereHas('ItemForm', function ($query) use ($req) {
            $query->where('form_name', 'like', '%' . $req->search . '%');
            $query->orderBy('form_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By Unit
    public function SearchPharmacyProductUnit(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('ItemUnit')
        ->whereHas('ItemUnit', function ($query) use ($req) {
            $query->where('unit_name', 'like', '%' . $req->search . '%');
            $query->orderBy('unit_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method    

    //Pharmacy Product Search By Store
    public function SearchPharmacyProductStore(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->with('Store')
        ->whereHas('Store', function ($query) use ($req) {
            $query->where('store_name', 'like', '%' . $req->search . '%');
            $query->orderBy('store_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    //Pharmacy Product Search By ExpiredDate
    public function SearchPharmacyProductExpiredDate(Request $req){
        $heads = Transaction_Head::where('groupe_id', 5)->where('expired_date', 'like', '%' . $req->search . '%')
            ->orderBy('expired_date','asc')
            ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('pharmacy_product.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    /////////////////////////// --------------- Pharmacy Product Table Methods END ---------- //////////////////////////






    /////////////////////////// --------------- Inventory Store Methods start ---------- ////////////////////////////////
    

    

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



    //Get Transaction Heads By Name And Groupe
    public function GetProductByGroupe(Request $req){
        if($req->groupein == "1"){
            $heads = Transaction_Head::with("ItemUnit")->where('tran_head_name', 'like', '%'.$req->product.'%')
            ->whereIn('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->take(10)
            ->get();
            // dd($heads);

            if($heads->count() > 0){
                $list = "";
                foreach($heads as $index => $head) {
                    $list .= '<tr tabindex="' . ($index + 1) . '" data-id="'.$head->id.'" data-groupe="'.$head->groupe_id.'" data-unit="'.$head->ItemUnit->unit_name.'" data-unit-id="'.$head->item_unite_id.'" data-cp="'.$head->cost_price.'" data-mrp="'.$head->mrp.'">
                                <td>'.$head->tran_head_name.'</td>
                                <td>'.$head->form_id.'</td>
                                <td>'.$head->manufacture_id.'</td>
                                <td>'.$head->category_id.'</td>
                                <td>'.$head->quantity.'</td>
                                <td>'.$head->mrp.'</td>
                              </tr>';
                }
            }
            else{
                $list = '<tr> 
                            <td> No Data Found </td> 
                        </tr>';
            }
            return $list;
        }
        else{
            $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->product.'%')
            ->where('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->take(10)
            ->get();


            if($heads->count() > 0){
                $list = "";
                foreach($heads as $index => $head) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$head->id.'" data-groupe="'.$head->groupe_id.'">'.$head->tran_head_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
    }//End Method
}