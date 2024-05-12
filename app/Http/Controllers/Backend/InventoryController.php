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

class InventoryController extends Controller
{
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
    
    
}
