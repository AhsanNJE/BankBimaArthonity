<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Party_Payment_Receive;
use App\Models\Transaction_Groupe;

class PartyPaymentController extends Controller
{
    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
    
    //Show All Party Payments
    public function ShowParty(){
        $party = Party_Payment_Receive::orderBy('tran_date','asc')->paginate(15);
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


    //Insert Party Payments
    public function InsertParty(Request $req){
        $req->validate([
            "tranId" => 'required',
            "invoice" => 'required',
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

        Party_Payment_Receive::insert([
            "tran_id" => $req->tranId,
            "invoice" => $req->invoice,
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
    }//End Method




    //Edit Party Payments
    public function EditParty(Request $req){
        $party = Party_Payment_Receive::with('Groupe','Head')->findOrFail($req->id);
        $groupes = Transaction_Groupe::get();
        $heads = Transaction_Head::where('groupe_id', '=', $transaction->tran_groupe_id)->get();
        return response()->json([
            'party'=>$party,
            'groupes'=>$groupes,
            'heads'=>$heads,
        ]);
    }//End Method



    //Update Party Payments
    public function UpdateParty(Request $req){
        if($req->dId != ""){
            $transaction = Party_Payment_Receive::findOrFail($req->dId);

            $req->validate([
                "groupe"  => 'required|numeric',
                "head"  => 'required|numeric',
                "quantity"  => 'required|numeric',
                "amount"  => 'required|numeric',
                "totAmount"  => 'required|numeric',
            ]);

            $update = Party_Payment_Receive::findOrFail($req->dId)->update([
                "tran_groupe_id" => $req->groupe,
                "tran_head_id" => $req->head,
                "quantity" => $req->quantity,
                "amount" => $req->amount,
                "tot_amount" => $req->totAmount,
                "updated_at" => now()
            ]);

            if($update){
                return response()->json([
                    'status'=>'success'
                ]); 
            }
        }
        else{
            $req->validate([
                "tranId" => 'required',
                "invoice" => 'required',
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
    
            Party_Payment_Receive::insert([
                "tran_id" => $req->tranId,
                "invoice" => $req->invoice,
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
    }//End Method



    //Delete Party Payments
    public function DeleteParty(Request $req){
        Party_Payment_Receive::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    /////////////////////////// --------------- Party Payments Table Methods start ---------- //////////////////////////
}
