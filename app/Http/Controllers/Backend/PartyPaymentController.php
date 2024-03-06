<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Party_Payment_Receive;
use App\Models\Transaction_Groupe;
use App\Models\Transaction_Head;
use App\Models\Transaction_Main;
use App\Models\Transaction_Detail;

class PartyPaymentController extends Controller
{
    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    
    //Show All Party Payments
    public function ShowParty(){
        $party = Party_Payment_Receive::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        $groupes = Transaction_Groupe::get();
        return view('party_payment.partyPayments', compact('party','groupes'));
    }//End Method


    //Get Transaction id by transaction Type
    public function GetTransactionId(Request $req){
        if($req->type != ""){
            if($req->type == 'receive'){
                $party = Party_Payment_Receive::where('tran_type', 'receive')->latest('tran_id')->first();
                $id = ($party) ? 'PR' . str_pad((intval(substr($party->tran_id, 2)) + 1), 8, '0', STR_PAD_LEFT) : 'PR00000001';

                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
            else if($req->type == "payment"){
                $party = Party_Payment_Receive::where('tran_type', 'payment')->latest('tran_id')->first();
                $id = ($party) ? 'PP' . str_pad((intval(substr($party->tran_id, 2)) + 1), 8, '0', STR_PAD_LEFT) : 'PP00000001';

                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
        }
    }//End Method



    public function GetTransactionUser(Request $req){
        if($req->tranUserType != ""){
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->where('tran_user_type', 'like', '%'.$req->tranUserType.'%')
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();

            if($users->count() > 0){
                $list = "";
                foreach($users as $index => $user) {
                    $list .= '<li tabindex="'.($index + 1).'" data-id="'.$user->user_id.'">'.$user->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else{
            return '<li>Select Transaction with first</li>';
        }
    }


    //Get Transacetion Due Grid By User Id
    public function GetTransactionDueByUserId(Request $req){
        if($req->id != ""){
            $transaction = Transaction_Main::where('tran_user', 'like', '%'.$req->id.'%')
            ->where('due', '>', 0)
            ->orderBy('tran_date','asc')
            ->paginate(15);

            if ($transaction) {
                return response()->json([
                    'status' => 'success',
                    'data' => view('party_payment.dueTransactionGrid', compact('transaction'))->render(),
                    'transaction' => $transaction
                ]);
            } else {
                return response()->json([
                    'status' => 'null'
                ]); 
            }
        }
    }//End Method


    //Insert Party Payments
    public function InsertParty(Request $req){
        $req->validate([
            "tranId" => 'required',
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


        // dd($req->user);
        if($req->user != ""){
            $transaction = Transaction_Main::where('tran_user', 'like', '%'.$req->user.'%')
            ->where('due', '>', 0)
            ->orderBy('tran_date','asc')
            ->get();

            // dd($transaction);
            if($transaction){
                $totAmount = $req->totAmount;
                $totDue = 0;
                foreach($transaction as $index => $tran) {
                    $totDue = $totDue + $tran->due;
                }
                if($totAmount != 0){
                    if($totDue < $totAmount){
                        return response()->json([
                            'message' => 'Amount should be less than equal to the due amount',
                            'errors' => [
                                'totAmount' => ['Amount should be less than equal to the due amount']
                            ]
                        ], 422);
                    }
                    else{
                        foreach($transaction as $index => $tran) {
                            if($totAmount != 0){
                                if($tran->due <= $totAmount){
                                    $totAmount = $totAmount - $tran->due;
                                    $dueCol = $tran->due_col + $tran->due;
                                    Transaction_Main::findOrFail($tran->id)->update([
                                        "due_col" => $dueCol,
                                        "due" => 0,
                                        "updated_at" => now()
                                    ]);
                                }
                                else if($tran->due > $totAmount){
                                    $remDue = $tran->due - $totAmount;                           
                                    $dueCol = $tran->due_col + $totAmount;
    
                                    Transaction_Main::findOrFail($tran->id)->update([
                                        "due_col" => $dueCol,
                                        "due" => $remDue,
                                        "updated_at" => now()
                                    ]);
                                    $totAmount = 0;
                                }
                            }
                        }
                        
                        $party = Party_Payment_Receive::insert([
                            "tran_id" => $req->tranId,
                            "loc_id" => $req->location,
                            "tran_type" => $req->type,
                            "tran_groupe_id" => $req->groupe,
                            "tran_head_id" => $req->head,
                            "tran_type_with" => $req->with,
                            "tran_user" => $req->user,
                            "amount" => $req->amount,
                            "quantity" => $req->quantity,
                            "tot_amount" => $req->totAmount,
                        ]);
    
                        return response()->json([
                            'status'=>'success',
                        ]); 
                    }
                }
            }
        }
    }//End Method




    //Edit Party Payments
    public function EditParty(Request $req){
        $party = Party_Payment_Receive::with('Location','User')->findOrFail($req->id);
        $groupes = Transaction_Groupe::get();
        $heads = Transaction_Head::where('groupe_id', '=', $party->tran_groupe_id)->get();
        return response()->json([
            'party'=>$party,
            'groupes'=>$groupes,
            'heads'=>$heads,
        ]);
    }//End Method



    // //Update Party Payments
    // public function UpdateParty(Request $req){
    //     if($req->dId != ""){
    //         $transaction = Party_Payment_Receive::findOrFail($req->dId);

    //         $req->validate([
    //             "groupe"  => 'required|numeric',
    //             "head"  => 'required|numeric',
    //             "quantity"  => 'required|numeric',
    //             "amount"  => 'required|numeric',
    //             "totAmount"  => 'required|numeric',
    //         ]);

    //         $update = Party_Payment_Receive::findOrFail($req->dId)->update([
    //             "tran_groupe_id" => $req->groupe,
    //             "tran_head_id" => $req->head,
    //             "quantity" => $req->quantity,
    //             "amount" => $req->amount,
    //             "tot_amount" => $req->totAmount,
    //             "updated_at" => now()
    //         ]);

    //         if($update){
    //             return response()->json([
    //                 'status'=>'success'
    //             ]); 
    //         }
    //     }
    //     else{
    //         $req->validate([
    //             "tranId" => 'required',
    //             "location" => 'required|numeric',
    //             "type" => 'required',
    //             "groupe" => 'required',
    //             "head" => 'required',
    //             "with" => 'required',
    //             "user" => 'required',
    //             "amount" => 'required',
    //             "quantity" => 'required',
    //             "totAmount" => 'required',
    //         ]);
    
    //         Party_Payment_Receive::insert([
    //             "tran_id" => $req->tranId,
    //             "loc_id" => $req->location,
    //             "tran_type" => $req->type,
    //             "tran_groupe_id" => $req->groupe,
    //             "tran_head_id" => $req->head,
    //             "tran_type_with" => $req->with,
    //             "tran_user" => $req->user,
    //             "amount" => $req->amount,
    //             "quantity" => $req->quantity,
    //             "tot_amount" => $req->totAmount,
    //         ]);
    
    //         return response()->json([
    //             'status'=>'success',
    //         ]);  
    //     }
    // }//End Method



    // //Delete Party Payments
    // public function DeleteParty(Request $req){
    //     Party_Payment_Receive::findOrFail($req->id)->delete();
    //     return response()->json([
    //         'status'=>'success'
    //     ]); 
    // }//End Method


    //Party Pagination
    public function PartyPagination(Request $req){
        if($req->type == null ){
            $party = Party_Payment_Receive::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        }
        else{
            $party = Party_Payment_Receive::where('tran_type', $req->type)->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        }
        return view('party_payment.partyPaymentPagination', compact('party'));
    }//End Method




    // Get Party Details by Date Range
    public function ShowPartyByDate(Request $req){
        if($req->type == null ){
            $party = Party_Payment_Receive::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_date','asc')->paginate(15);
        }
        else{
            $party = Party_Payment_Receive::where('tran_type', $req->type)->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_date','asc')->paginate(15);
        }

        $paginationHtml = $party->links()->toHtml();
        
        if($party->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('party_payment.search', compact('party'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    // Get Party by TranId
    public function SearchPartyByTranId(Request $req){
        if($req->type == null ){
            $party = Party_Payment_Receive::where('tran_id', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_id','asc')->paginate(15);
        }
        else{
            $party = Party_Payment_Receive::where('tran_type', $req->type)->where('tran_id', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_id','asc')->paginate(15);
        }
        
        $paginationHtml = $party->links()->toHtml();
        
        if($party->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('party_payment.search', compact('party'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method



    // Get Party by Tran With
    public function SearchPartyByTranWith(Request $req){
        if($req->type == null ){
            $party = Party_Payment_Receive::where('tran_type_with', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_type_with','asc')->paginate(15);
        }
        else{
            $party = Party_Payment_Receive::where('tran_type', $req->type)->where('tran_type_with', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_type_with','asc')->paginate(15);
        }
        
        $paginationHtml = $party->links()->toHtml();
        
        if($party->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('party_payment.search', compact('party'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    
    // Get Party by User
    public function SearchPartyByUser(Request $req){
        if($req->type == null ){
            $party = Party_Payment_Receive::with('User')
            ->whereHas('User', function ($query) use ($req) {
                $query->where('user_name', 'like', '%'.$req->search.'%');
                $query->orderBy('user_name','asc');
            })
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        else{
            $party = Party_Payment_Receive::with('User')
            ->whereHas('User', function ($query) use ($req) {
                $query->where('user_name', 'like', '%'.$req->search.'%');
                $query->orderBy('user_name','asc');
            })
            ->where('tran_type', $req->type)
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        

        $paginationHtml = $party->links()->toHtml();

        if($party->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('party_payment.search', compact('party'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////


    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    //Show Party Payments Receive From Client
    public function ShowReceiveParty(){
        $party = Party_Payment_Receive::where('tran_type', "receive")->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        $groupes = Transaction_Groupe::get();
        return view('party_payment.receive.partyPayments', compact('party','groupes'));
    }//End Method

    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    


    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    //Show Party Payments Payment To Supplier
    public function ShowPaymentParty(){
        $party = Party_Payment_Receive::where('tran_type', "payment")->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        $groupes = Transaction_Groupe::get();
        return view('party_payment.payment.partyPayments', compact('party','groupes'));
    }//End Method

    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    
}
