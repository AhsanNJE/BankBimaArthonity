<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Groupe;
use App\Models\Transaction_Head;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Main;
use App\Models\Transaction_With;
use App\Models\User_Info;


class TransactionController extends Controller
{
    /////////////////////////// --------------- Transaction Groupe Table Methods start ---------- //////////////////////////
    //Show All Transaction Groupes
    public function ShowTransactionGroupes(){
        $groupes = Transaction_Groupe::orderBy('added_at','desc')->paginate(15);
        return view('transaction.transactionGroupe.transactionGroupes', compact('groupes'));
    }//End Method



    //Get Transaction Groupes By Name
    public function GetTransactionGroupeByName(Request $req){
        $groupes = Transaction_Groupe::where('tran_groupe_name', 'like', '%'.$req->groupe.'%')
        ->orderBy('tran_groupe_name','asc')
        ->take(10)
        ->get();


        if($groupes->count() > 0){
            $list = "";
            foreach($groupes as $index => $groupe) {
                $list .= '<li tabindex="'.($index + 1).'" data-id="'.$groupe->id.'">'.$groupe->tran_groupe_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    }//End Method


    //Get Transaction Groupes By Type
    public function GetTransactionGroupeByType(Request $req){
        $groupes = Transaction_Groupe::where('tran_groupe_type', 'like', '%'.$req->type.'%')
        ->orderBy('tran_groupe_type','asc')
        ->get();


        return response()->json([
            'status' => "success",
            'groupes'=> $groupes,
        ]);
    }//End Method




    //Insert Transaction Groupes
    public function InsertTransactionGroupes(Request $req){
        $req->validate([
            "groupeName" => 'required|unique:transaction__groupes,tran_groupe_name',
            "type" => 'required|in:Payment,Receive,Invoice,Both',
        ]);

        Transaction_Groupe::insert([
            "tran_groupe_name" => $req->groupeName,
            "tran_groupe_type" => $req->type,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Transaction Groupes
    public function EditTransactionGroupes(Request $req){
        $groupes = Transaction_Groupe::findOrFail($req->id);
        return response()->json([
            'groupes'=>$groupes,
        ]);
    }//End Method



    //Update Transaction Groupes
    public function UpdateTransactionGroupes(Request $req){
        $groupes = Transaction_Groupe::findOrFail($req->id);

        $req->validate([
            "groupeName" => ['required',Rule::unique('transaction__groupes', 'tran_groupe_name')->ignore($groupes->id)],
            "type" => 'required|in:Payment,Receive,Invoice,Both',
        ]);

        $update = Transaction_Groupe::findOrFail($req->id)->update([
            "tran_groupe_name" => $req->groupeName,
            "tran_groupe_type" => $req->type,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Transaction Groupes
    public function DeleteTransactionGroupes(Request $req){
        Transaction_Groupe::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Transaction Groupes Pagination
    public function TransactionGroupePagination(){
        $groupes = Transaction_Groupe::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('transaction.transactionGroupe.transactionGroupePagination', compact('groupes'))->render(),
        ]);
    }//End Method



    //Transaction Groupes Search
    public function SearchTransactionGroupes(Request $req){
        $groupes = Transaction_Groupe::where('tran_groupe_name', 'like', '%'.$req->search.'%')
        ->orderBy('tran_groupe_name','asc')
        ->paginate(15);

        $paginationHtml = $groupes->links()->toHtml();
        
        if($groupes->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.transactionGroupe.search', compact('groupes'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Transaction Groupes Table Methods End ---------- //////////////////////////




    /////////////////////////// --------------- Transaction Heads Table Methods start ---------- //////////////////////////
    
    //Show All Transaction Heads
    public function ShowTransactionHeads(){
        $groupes = Transaction_Groupe::orderBy('added_at','desc')->get();
        $heads = Transaction_Head::orderBy('added_at','desc')->paginate(15);
        return view('transaction.transactionHead.transactionHeads', compact('heads', 'groupes'));
    }//End Method



    //Get Transaction Heads By Name And Groupe
    public function GetTransactionHeadByGroupe(Request $req){
        if($req->head != ""){
            $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->head.'%')
            ->where('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->get();

            if($heads->count() > 0){
                $list = "";
                foreach($heads as $head) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$head->id.'">'.$head->tran_head_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else if(!$req->head){
            $heads = Transaction_Head::where('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->get();

            if($heads->count() > 0){
                $list = '<option value="">Select transaction Heads</option>';
                foreach($heads as $index => $head) {
                    $list .= '<option value="'.$head->id.'">'.$head->tran_head_name.'</option>';
                }
            }
            else{
                $list = '<option value="">Select transaction Heads</option>';
            }
            return $list;
        }
        else{
            return $list = "";
        }
    }//End Method


    //Insert Transaction Heads
    public function InsertTransactionHeads(Request $req){
        $req->validate([
            "headName" => 'required|unique:transaction__heads,tran_head_name',
            "groupe" => 'required|numeric'
        ]);

        Transaction_Head::insert([
            "tran_head_name" => $req->headName,
            "groupe_id" => $req->groupe,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Transaction Heads
    public function EditTransactionHeads(Request $req){
        $groupes = Transaction_Groupe::orderBy('added_at','desc')->get();
        $heads = Transaction_Head::with('Groupe')->findOrFail($req->id);
        return response()->json([
            'heads'=>$heads,
            'groupes' => $groupes,
        ]);
    }//End Method



    //Update Transaction Heads
    public function UpdateTransactionHeads(Request $req){
        $heads = Transaction_Head::findOrFail($req->id);

        $req->validate([
            "headName" => ['required',Rule::unique('transaction__heads', 'tran_head_name')->ignore($heads->id)],
            "groupe"  => 'required|numeric'
        ]);

        $update = Transaction_Head::findOrFail($req->id)->update([
            "tran_head_name" => $req->headName,
            "groupe_id" => $req->groupe,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Transaction Heads
    public function DeleteTransactionHeads(Request $req){
        Transaction_Head::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Transaction Heads Pagination
    public function TransactionHeadPagination(){
        $heads = Transaction_Head::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('transaction.transactionHead.transactionHeadPagination', compact('heads'))->render(),
        ]);
    }//End Method



    //Transaction Heads Search
    public function SearchTransactionHeads(Request $req){
        $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->search.'%')
        ->orderBy('tran_head_name','asc')
        ->paginate(15);

        $paginationHtml = $heads->links()->toHtml();
        
        if($heads->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.transactionHead.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //Transaction Heads Search by groupe
    public function SearchTransactionHeadsByGroupe(Request $req){
        $heads = Transaction_Head::with('Groupe')
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
                'data' => view('transaction.transactionHead.search', compact('heads'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Transaction Heads Table Methods Ends ---------- //////////////////////////




    /////////////////////////// --------------- Transaction Details Table Methods start ---------- //////////////////////////
    //Show All Transaction
    public function ShowTransactions(){
        $transaction = Transaction_Main::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        return view('transaction.details.transactionDetails', compact('transaction'));
    }//End Method


    //Get Transaction id by transaction Type
    public function GetTransactionId(Request $req){
        if($req->type != ""){
            if($req->type == 'receive'){
                $transaction = Transaction_Main::where('tran_type', 'receive')->latest('tran_id')->first();
                $id = ($transaction) ? 'R' . str_pad((intval(substr($transaction->tran_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'R000000001';

                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
            else if($req->type == "payment"){
                $transaction = Transaction_Main::where('tran_type', 'payment')->latest('tran_id')->first();
                $id = ($transaction) ? 'P' . str_pad((intval(substr($transaction->tran_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'P000000001';

                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
        }
    }//End Method



    //Get Transaction with by transaction Type
    public function GetTransactionWith(Request $req){
        if($req->type != ""){
            if($req->type == 'receive'){
                $tranwith = Transaction_With::where('user_type', 'Client')->get();

                return response()->json([
                    'status' => 'success',
                    'tranwith' => $tranwith,
                ]);
            }
            else if($req->type == "payment"){
                $tranwith = Transaction_With::whereIn('user_type', ['Supplier', 'Employee'])->get();

                return response()->json([
                    'status' => 'success',
                    'tranwith' => $tranwith,
                ]);
            }
        }
    }//End Method



    // Get transaction User By Transaction User Type
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
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$user->user_id.'">'.$user->user_name.'</li>';
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


    //Get Inserted Transacetion Grid By Transaction Id
    public function GetTransactionGrid(Request $request){
        if($request->tranId != ""){
            $transaction = Transaction_Detail::where('tran_id', 'like', $request->tranId)
            ->orderBy('tran_id','asc')
            ->paginate(15);

            if ($transaction) {
                return response()->json([
                    'status' => 'success',
                    'data' => view('transaction.details.transactionGrid', compact('transaction'))->render(),
                    'transaction' => $transaction
                ]);
            } else {
                return response()->json([
                    'status' => 'null'
                ]); 
            }
        }
    }//End Method




    //Insert Transaction Details
    public function InsertTransactionDetails(Request $req){
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

        Transaction_Detail::insert([
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



    //Insert Transaction Main
    public function InsertTransactionMain(Request $req){
        $req->validate([
            "tranId" => 'required|unique:transaction__mains,tran_id',
            "type" => 'required',
            "invoice" => 'required',
            "withs" => 'required',
            "user" => 'required',
            "locations" => 'required',
            "amountRP" => 'required',
            "discount" => 'required',
            "netAmount" => 'required',
            "advance" => 'required',
            "balance" => 'required',
        ]);


        if($req->type == 'receive'){
            $receive = $req->advance;
            $payment = null;
        }
        else if($req->type == "payment"){
            $payment = $req->advance;
            $receive = null;
        }

        Transaction_Main::insert([
            "tran_id" => $req->tranId,
            "tran_type" => $req->type,
            "invoice" => $req->invoice,
            "tran_type_with" => $req->withs,
            "tran_user" => $req->user,
            "loc_id" => $req->locations,
            "bill_amount" => $req->amountRP,
            "discount" => $req->discount,
            "net_amount" => $req->netAmount,
            "receive" => $receive,
            "payment" => $payment,
            "due" => $req->balance,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Transaction Main
    public function EditTransactionMain(Request $req){
        $transaction = Transaction_Main::with('Location','User','withs')->where('tran_id', $req->id )->first();
        $tranwith = Transaction_With::where('user_type', '=', $transaction->withs->user_type)->get();
        return response()->json([
            'transaction'=>$transaction,
            'tranwith' =>$tranwith
        ]);
    }//End Method


    //Edit Transaction Details
    public function EditTransactionDetails(Request $req){
        $transaction = Transaction_Detail::with('Groupe','Head')->findOrFail($req->id);
        $groupes = Transaction_Groupe::where('tran_groupe_type', $transaction->tran_type)->get();
        $heads = Transaction_Head::where('groupe_id', '=', $transaction->tran_groupe_id)->get();
        return response()->json([
            'transaction'=>$transaction,
            'groupes'=>$groupes,
            'heads'=>$heads,
        ]);
    }//End Method



    //Update Transaction Details
    public function UpdateTransactionDetails(Request $req){
        if($req->dId != ""){
            $transaction = Transaction_Detail::findOrFail($req->dId);
            $req->validate([
                "groupe"  => 'required|numeric',
                "head"  => 'required|numeric',
                "quantity"  => 'required|numeric',
                "amount"  => 'required|numeric',
                "totAmount"  => 'required|numeric',
            ]);

            $update = Transaction_Detail::findOrFail($req->dId)->update([
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
    
            Transaction_Detail::insert([
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



    // Update Transaction Main
    public function UpdateTransactionMain(Request $req){
        $transaction = Transaction_Main::findOrFail($req->id);
        $req->validate([
            "amountRP"  => 'required|numeric',
            "totalDiscount"  => 'required|numeric',
            "netAmount"  => 'required|numeric',
            "advance"  => 'required|numeric',
            "balance"  => 'required|numeric',
        ]);


        if($req->type == 'receive'){
            $receive = $req->advance;
            $payment = null;
        }
        else if($req->type == "payment"){
            $payment = $req->advance;
            $receive = null;
        }

        $update = Transaction_Main::findOrFail($req->id)->update([
            "bill_amount" => $req->amountRP,
            "discount" => $req->totalDiscount,
            "net_amount" => $req->netAmount,
            "receive" => $receive,
            "payment" => $payment,
            "due" => $req->balance,
            "updated_at" => now()
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }



    //Delete Transaction Details
    public function DeleteTransactionDetails(Request $req){
        Transaction_Detail::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Delete Transaction Main
    public function DeleteTransactionMain(Request $req){
        Transaction_Main::where("tran_id", $req->id)->delete();
        Transaction_Detail::where("tran_id", $req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Transaction Pagination
    public function TransactionPagination(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        }
        else{
            $transaction = Transaction_Main::where('tran_type', $req->type)->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        }
        return view('transaction.details.transactionPagination', compact('transaction'));
    }//End Method



    // Get Transaction Details by Date Range
    public function ShowTransactionByDate(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_date','asc')->paginate(15);
        }
        else{
            $transaction = Transaction_Main::where('tran_type', $req->type)->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_date','asc')->paginate(15);
        }
        $paginationHtml = $transaction->links()->toHtml();
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('transaction.details.search', compact('transaction'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Get Transaction by TranId
    public function SearchTransactionByTranId(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::where('tran_id', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_id','asc')->paginate(15);
        }
        else{
            $transaction = Transaction_Main::where('tran_type', $req->type)->where('tran_id', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('tran_id','asc')->paginate(15);
        }
        
        $paginationHtml = $transaction->links()->toHtml();
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('transaction.details.search', compact('transaction'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    // Get Transaction by Invoice
    public function SearchTransactionByInvoice(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::where('invoice', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('invoice','asc')->paginate(15);
        }
        else{
            $transaction = Transaction_Main::where('tran_type', $req->type)->where('invoice', "like", '%'. $req->search .'%')->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])->orderBy('invoice','asc')->paginate(15);
        }
        
        $paginationHtml = $transaction->links()->toHtml();
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('transaction.details.search', compact('transaction'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    // Get Transaction by Tran With
    public function SearchTransactionByTranWith(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::with('Withs')
            ->whereHas('Withs', function ($query) use ($req) {
                $query->where('tran_with_name', 'like', '%'.$req->search.'%');
                $query->orderBy('tran_with_name','asc');
            })
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        else{
            $transaction = Transaction_Main::with('Withs')
            ->whereHas('Withs', function ($query) use ($req) {
                $query->where('tran_with_name', 'like', '%'.$req->search.'%');
                $query->orderBy('tran_with_name','asc');
            })
            ->where('tran_type', $req->type)
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        
        $paginationHtml = $transaction->links()->toHtml();
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('transaction.details.search', compact('transaction'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    
    // Get Transaction by Tran User
    public function SearchTransactionByTranUser(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::with('User')
            ->whereHas('User', function ($query) use ($req) {
                $query->where('user_name', 'like', '%'.$req->search.'%');
                $query->orderBy('user_name','asc');
            })
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        else{
            $transaction = Transaction_Main::with('User')
            ->whereHas('User', function ($query) use ($req) {
                $query->where('user_name', 'like', '%'.$req->search.'%');
                $query->orderBy('user_name','asc');
            })
            ->where('tran_type', $req->type)
            ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
            ->paginate(15);
        }
        

        $paginationHtml = $transaction->links()->toHtml();

        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('transaction.details.search', compact('transaction'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    /////////////////////////// --------------- Transaction Details Table Methods Ends ---------- //////////////////////////



    /////////////////////////// --------------- Transaction Receive Methods start ---------- //////////////////////////
    //Show All Transaction Receive Details
    public function ShowTransactionReceive(){
        $transaction = Transaction_Main::where('tran_type','receive')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', 'Receive')->orderBy('added_at','asc')->get();
        return view('transaction.details.receive.transactionReceive', compact('transaction','groupes'));
    }//End Method

    /////////////////////////// --------------- Transaction Receive Table Methods Ends ---------- //////////////////////////
    
    
    
    
    /////////////////////////// --------------- Transaction Payment Methods start ---------- //////////////////////////
    //Show All Transaction Payment Details
    public function ShowTransactionPayment(){
        $transaction = Transaction_Main::where('tran_type','payment')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','desc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', 'Payment')->orderBy('added_at','asc')->get();
        return view('transaction.details.payment.transactionPayment', compact('transaction','groupes'));
    }//End Method


    /////////////////////////// --------------- Transaction Payment Table Methods Ends ---------- //////////////////////////
}
