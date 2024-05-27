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

class PharmacyController extends Controller
{
    /////////////////////////// --------------- Pharmacy Purchase Methods start ---------- //////////////////////////
    // Show All Purchase Details
    public function ShowPharmacyPurchase(){
        $pharmacy = Transaction_Main::where('tran_method','Purchase')->where('tran_type','6')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '6')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('pharmacy.purchase.pharmacyPurchase', compact('pharmacy','groupes'));
    }//End Method'


    //Insert Transaction Details
    public function InsertPharmacyPurchase(Request $req){
        $req->validate([
            "tranId" => 'required',
            "method" => 'required',
            "type" => 'required',
            "groupe" => 'required',
            "head" => 'required',
            "with" => 'required',
            "user" => 'required',
            "amount" => 'required',
            "quantity" => 'required',
            "totAmount" => 'required',
            "mrp" => 'required',
            "store" => 'required'
        ]);

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
        else{
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
                "mrp" => $req->mrp,
                "expiry_date" => $req->expiry == null ? null :$req->expiry,
                "store" => $req->store
            ]);
    
            return response()->json([
                'status'=>'success',
            ]);
        }

    }//End Method



    //Insert Transaction Main
    public function InsertPharmacyPurchaseMain(Request $req){
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

        $receive = $req->method === 'Receive' ? $req->advance : null;
        $payment = $req->method === 'Payment' ? $req->advance : null;
        
        
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
            "receive" => $receive,
            "payment" => $payment,
            "due" => $req->balance,
            "store" => $req->store
        ]);

        return response()->json(['status' => 'success']);
    }//End Method




    /////////////////////////// --------------- Pharmacy Purchase Methods Ends ---------- //////////////////////////
    





    /////////////////////////// --------------- Pharmacy Issue Methods start ---------- //////////////////////////
    // Show All Issue Details
    public function ShowPharmacyIssue(){
        $pharmacy = Transaction_Main::where('tran_method','Receive')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '6')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('pharmacy.issue.pharmacyIssue', compact('pharmacy','groupes'));
    }//End Method


    //Insert Pharmacy Issue
    public function InsertPharmacyIssue(Request $req){
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




    // Pharmacy Issue Pagination
    public function PharmacyIssuePagination(Request $req){
        $pharmacy = Transaction_Main::where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        return view('pharmacy.issue.pharmacyIssuePagination', compact('pharmacy'));
    }//End Method



    // Get Pharmacy Issue by Date Range
    public function ShowPharmacyIssueByDate(Request $req){
        $pharmacy = Transaction_Main::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method', $req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $pharmacy->links()->toHtml();

        
        if($pharmacy->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('pharmacy.issue.search', compact('pharmacy'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Get Pharmacy Issue by TranId
    public function SearchPharmacyIssueByTranId(Request $req){
        $pharmacy = Transaction_Main::where('tran_id', "like", '%'. $req->search .'%')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_id','asc')
        ->paginate(15);
        
        $paginationHtml = $pharmacy->links()->toHtml();
        
        if($pharmacy->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('pharmacy.issue.search', compact('pharmacy'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    
    // Get Pharmacy Issue by Tran User
    public function SearchPharmacyIssueByTranUser(Request $req){
        $pharmacy = Transaction_Main::with('User')
        ->whereHas('User', function ($query) use ($req) {
            $query->where('user_name', 'like', '%'.$req->search.'%');
            $query->orderBy('user_name','asc');
        })
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->paginate(15);
        

        $paginationHtml = $pharmacy->links()->toHtml();

        if($pharmacy->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('pharmacy.issue.search', compact('pharmacy'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method

    /////////////////////////// --------------- Pharmacy Issue Methods Ends ---------- //////////////////////////
    




    /////////////////////////// --------------- Pharmacy Return Methods start ---------- //////////////////////////
    // Show All Return Details
    public function ShowPharmacyReturn(){
        $pharmacy = Transaction_Main::where('tran_method','Payment')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '5')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('pharmacy.return.pharmacyReturn', compact('pharmacy','groupes'));
    }//End Method

    /////////////////////////// --------------- Pharmacy Return Methods Ends ---------- //////////////////////////
    
}
