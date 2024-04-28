<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Type;
use App\Models\Transaction_With;
use App\Models\Transaction_Groupe;
use App\Models\Transaction_Head;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Main;
use App\Models\User_Info;
use App\Models\Party_Payment_Receive;

class TransactionController extends Controller
{
    /////////////////////////// --------------- Transaction Types Table Methods start ---------- //////////////////////////
    //Show All Transaction Types
    public function ShowTransactionTypes(){
        $types = Transaction_Type::orderBy('added_at','asc')->paginate(15);
        return view('transaction.type.transactionTypes', compact('types'));
    }//End Method



    //Get Transaction Types
    public function GetTransactionType(){
        $types = Transaction_Type::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => "success",
            'types'=> $types,
        ]);
    }//End Method



    //Insert Transaction Types
    public function InsertTransactionTypes(Request $req){
        $req->validate([
            "typeName" => 'required|unique:transaction__types,type_name',
        ]);

        Transaction_Type::insert([
            "type_name" => $req->typeName,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Transaction Typess
    public function EditTransactionTypes(Request $req){
        $types = Transaction_Type::findOrFail($req->id);
        return response()->json([
            'types'=>$types,
        ]);
    }//End Method



    //Update Transaction Types
    public function UpdateTransactionTypes(Request $req){
        $types = Transaction_Type::findOrFail($req->id);

        $req->validate([
            "typeName" => ['required',Rule::unique('transaction__types', 'type_name')->ignore($types->id)],
        ]);

        $update = Transaction_Type::findOrFail($req->id)->update([
            "type_name" => $req->typeName,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Transaction Types
    public function DeleteTransactionTypes(Request $req){
        Transaction_Type::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Transaction Types Pagination
    public function TransactionTypePagination(){
        $types = Transaction_Type::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('transaction.type.transactionTypePagination', compact('types'))->render(),
        ]);
    }//End Method



    //Transaction Types Search
    public function SearchTransactionTypes(Request $req){
        $types = Transaction_Type::where('type_name', 'like', '%'.$req->search.'%')
        ->orderBy('type_name','asc')
        ->paginate(15);

        $paginationHtml = $types->links()->toHtml();
        
        if($types->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.type.search', compact('types'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Transaction Types Table Methods End ---------- //////////////////////////



    /////////////////////////// --------------- Tran With Table Methods start ---------- //////////////////////////
    
    //Show All TranWith
    public function ShowTranWith(){
        $tranwith = Transaction_With::orderBy('added_at','asc')->paginate(15);
        $types = Transaction_Type::orderBy('added_at','asc')->get();
        return view('transaction.tran_with.tranWith', compact('tranwith','types'));
    }//End Method



    //Get Tran With By Type
    public function GetTranWithByType(Request $req){
        $tranwith = Transaction_With::where('user_type', $req->type)
        ->orderBy('user_type','asc')
        ->get();

        return response()->json([
            'status'=>'success',
            'tranwith'=>$tranwith,
        ]);  

    }//End Method



    //Insert Tran With
    public function InsertTranWith(Request $req){
        $req->validate([
            "name" => 'required|unique:transaction__withs,tran_with_name',
            "type" => 'required|in:Client,Employee,Supplier,Bank,Others',
            "tranType" => 'required',
            "tranMethod" => 'required',
        ]);

        Transaction_With::insert([
            "tran_with_name" => $req->name,
            "user_type" => $req->type,
            "tran_type" => $req->tranType,
            "tran_method" => $req->tranMethod,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Tran With
    public function EditTranWith(Request $req){
        $tranwith = Transaction_With::findOrFail($req->id);
        $types = Transaction_Type::orderBy('added_at','asc')->get();
        return response()->json([
            'tranwith'=>$tranwith,
            'types'=>$types,
        ]);
    }//End Method



    //Update Tran With
    public function UpdateTranWith(Request $req){
        $tranwith = Transaction_With::findOrFail($req->id);

        $req->validate([
            "name" => ['required',Rule::unique('transaction__withs', 'tran_with_name')->ignore($tranwith->id)],
            "type"  => 'required',
            "tranType" => 'required',
            "tranMethod" => 'required',
        ]);

        $update = Transaction_With::findOrFail($req->id)->update([
            "tran_with_name" => $req->name,
            "user_type" => $req->type,
            "tran_type" => $req->tranType,
            "tran_method" => $req->tranMethod,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Tran With
    public function DeleteTranWith(Request $req){
        Transaction_With::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Tran With Pagination
    public function TranWithPagination(){
        $tranwith = Transaction_With::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('transaction.tran_with.tranWithPagination', compact('tranwith'))->render(),
        ]);
    }//End Method



    //Transaction With Search By Name
    public function SearchTranWith(Request $req){
        $tranwith = Transaction_With::where('tran_with_name', 'like', '%'.$req->search.'%')
        ->orderBy('tran_with_name','asc')
        ->paginate(15);

        $paginationHtml = $tranwith->links()->toHtml();
        
        if($tranwith->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.tran_with.search', compact('tranwith'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //Transaction With Search By Type
    public function SearchTranWithByType(Request $req){
        $tranwith = Transaction_With::where('user_type', 'like', '%' . $req->search . '%')
        ->orderBy('user_type','asc')
        ->paginate(15);

        $paginationHtml = $tranwith->links()->toHtml();
        
        if($tranwith->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.tran_with.search', compact('tranwith'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Tran With Table Methods start ---------- //////////////////////////





    /////////////////////////// --------------- Transaction Groupe Table Methods start ---------- //////////////////////////
    //Show All Transaction Groupes
    public function ShowTransactionGroupes(){
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->paginate(15);
        $types = Transaction_Type::orderBy('added_at','asc')->get();
        return view('transaction.transactionGroupe.transactionGroupes', compact('groupes','types'));
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
            "type" => 'required|numeric',
            "method" => 'required|in:Receive,Payment,Both',
        ]);

        Transaction_Groupe::insert([
            "tran_groupe_name" => $req->groupeName,
            "tran_groupe_type" => $req->type,
            "tran_method" => $req->method,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Transaction Groupes
    public function EditTransactionGroupes(Request $req){
        $groupes = Transaction_Groupe::findOrFail($req->id);
        $types = Transaction_Type::orderBy('added_at','asc')->get();
        return response()->json([
            'groupes'=>$groupes,
            'types'=>$types,
        ]);
    }//End Method



    //Update Transaction Groupes
    public function UpdateTransactionGroupes(Request $req){
        $groupes = Transaction_Groupe::findOrFail($req->id);

        $req->validate([
            "groupeName" => ['required',Rule::unique('transaction__groupes', 'tran_groupe_name')->ignore($groupes->id)],
            "type" => 'required|numeric',
            "method" => 'required|in:Receive,Payment,Both',
        ]);

        $update = Transaction_Groupe::findOrFail($req->id)->update([
            "tran_groupe_name" => $req->groupeName,
            "tran_groupe_type" => $req->type,
            "tran_method" => $req->method,
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
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->paginate(15);
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
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        $heads = Transaction_Head::orderBy('added_at','asc')->paginate(15);
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
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
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
        $heads = Transaction_Head::orderBy('added_at','asc')->paginate(15);
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




    /////////////////////////// --------------- Transaction Methods start ---------- //////////////////////////
    //Show All Transaction
    public function ShowTransactions(){
        $transaction = Transaction_Main::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $types = Transaction_Type::orderBy('added_at','asc')->get();
        return view('transaction.general.transactions', compact('transaction','types'));
    }//End Method


    //Get Transaction Id By Transaction Method And Type 
    public function GetTransactionId(Request $req){
        if($req->type != ""){
            if($req->type == '1'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '1')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'REC' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'REC000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '1')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PAY' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PAY000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '2'){
                if($req->method == "Receive"){
                    $transaction = Party_Payment_Receive::where('tran_type', '2')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PPR' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PPR000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Party_Payment_Receive::where('tran_type', '2')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PPP' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PPP000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '3'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '3')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PRR' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PRR000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '3')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PRP' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PRP000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '4'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '4')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'BMW' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'BMW000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '4')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'BMD' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'BMD000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '5'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '5')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'ITR' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'ITR000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '5')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'ITP' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'ITP000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '6'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '6')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'KTR' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'KTR000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '6')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'KTP' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'KTP000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
            else if($req->type == '7'){
                if($req->method == "Receive"){
                    $transaction = Transaction_Main::where('tran_type', '7')->where('tran_method','Receive')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PTR' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PTR000000001';

                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
                else if($req->method == "Payment"){
                    $transaction = Transaction_Main::where('tran_type', '6')->where('tran_method','Payment')->latest('tran_id')->first();
                    $id = ($transaction) ? 'PTP' . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : 'PTP000000001';
    
                    return response()->json([
                        'status' => 'success',
                        'id' => $id,
                    ]);
                }
            }
        }
    }//End Method



    // Get Transaction With By Transaction Method And Type
    public function GetTransactionWith(Request $req){
        if($req->type != ""){
            $tranwith = Transaction_With::whereIn('tran_method', [$req->method, 'Both'])->where('tran_type',$req->type)->get();

            return response()->json([
                'status' => 'success',
                'tranwith' => $tranwith,
            ]);
        }
        else{
            $tranwith = Transaction_With::where('user_type', $req->user)->get();

            return response()->json([
                'status' => 'success',
                'tranwith' => $tranwith,
            ]);
        }
    }//End Method



    // Get Transaction User By Transaction User Type
    public function GetTransactionUser(Request $req){
        if($req->tranUserType != ""){
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->where('tran_user_type', 'like', $req->tranUserType)
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
                    'data' => view('transaction.general.transactionGrid', compact('transaction'))->render(),
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

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Insert Transaction Main
    public function InsertTransactionMain(Request $req){
        $req->validate([
            "tranId" => 'required|unique:transaction__mains,tran_id',
            "method" => 'required',
            "type" => 'required',
            "withs" => 'required',
            "user" => 'required',
            "locations" => 'required',
            "amountRP" => 'required',
            "discount" => 'required',
            "netAmount" => 'required',
            "advance" => 'required',
            "balance" => 'required',
        ]);


        if($req->method == 'Receive'){
            $receive = $req->advance;
            $payment = null;
        }
        else if($req->method == "Payment"){
            $payment = $req->advance;
            $receive = null;
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
            "receive" => $receive,
            "payment" => $payment,
            "due" => $req->balance,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    // //Edit Transaction Main
    // public function EditTransactionMain(Request $req){
    //     $transaction = Transaction_Main::with('Location','User','withs')->where('tran_id', $req->id )->first();
    //     $tranwith = Transaction_With::where('user_type', '=', $transaction->withs->user_type)->get();
    //     $types = Transaction_Type::orderBy('added_at','asc')->get();
    //     return response()->json([
    //         'transaction'=>$transaction,
    //         'tranwith' =>$tranwith,
    //         "types" =>$types
    //     ]);
    // }//End Method


    // //Edit Transaction Details
    // public function EditTransactionDetails(Request $req){
    //     $transaction = Transaction_Detail::with('Groupe','Head')->findOrFail($req->id);
    //     $groupes = Transaction_Groupe::where('tran_groupe_type', $transaction->tran_type)->get();
    //     $heads = Transaction_Head::where('groupe_id', '=', $transaction->tran_groupe_id)->get();
    //     return response()->json([
    //         'transaction'=>$transaction,
    //         'groupes'=>$groupes,
    //         'heads'=>$heads,
    //     ]);
    // }//End Method



    // //Update Transaction Details
    // public function UpdateTransactionDetails(Request $req){
    //     if($req->dId != ""){
    //         $transaction = Transaction_Detail::findOrFail($req->dId);
    //         $req->validate([
    //             "groupe"  => 'required|numeric',
    //             "head"  => 'required|numeric',
    //             "quantity"  => 'required|numeric',
    //             "amount"  => 'required|numeric',
    //             "totAmount"  => 'required|numeric',
    //         ]);

    //         $update = Transaction_Detail::findOrFail($req->dId)->update([
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
    //             "invoice" => 'required',
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
    
    //         Transaction_Detail::insert([
    //             "tran_id" => $req->tranId,
    //             "invoice" => $req->invoice,
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



    // // Update Transaction Main
    // public function UpdateTransactionMain(Request $req){
    //     $transaction = Transaction_Main::findOrFail($req->id);
    //     $req->validate([
    //         "amountRP"  => 'required|numeric',
    //         "totalDiscount"  => 'required|numeric',
    //         "netAmount"  => 'required|numeric',
    //         "advance"  => 'required|numeric',
    //         "balance"  => 'required|numeric',
    //     ]);


    //     if($req->type == 'receive'){
    //         $receive = $req->advance;
    //         $payment = null;
    //     }
    //     else if($req->type == "payment"){
    //         $payment = $req->advance;
    //         $receive = null;
    //     }

    //     $update = Transaction_Main::findOrFail($req->id)->update([
    //         "bill_amount" => $req->amountRP,
    //         "discount" => $req->totalDiscount,
    //         "net_amount" => $req->netAmount,
    //         "receive" => $receive,
    //         "payment" => $payment,
    //         "due" => $req->balance,
    //         "updated_at" => now()
    //     ]);

    //     if($update){
    //         return response()->json([
    //             'status'=>'success'
    //         ]); 
    //     }
    // }



    // //Delete Transaction Details
    // public function DeleteTransactionDetails(Request $req){
    //     Transaction_Detail::findOrFail($req->id)->delete();
    //     return response()->json([
    //         'status'=>'success'
    //     ]); 
    // }//End Method



    // //Delete Transaction Main
    // public function DeleteTransactionMain(Request $req){
    //     Transaction_Main::where("tran_id", $req->id)->delete();
    //     Transaction_Detail::where("tran_id", $req->id)->delete();
    //     return response()->json([
    //         'status'=>'success'
    //     ]); 
    // }//End Method



    //Transaction Pagination
    public function TransactionPagination(Request $req){
        if($req->type == null ){
            $transaction = Transaction_Main::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        }
        else{
            $transaction = Transaction_Main::where('tran_method', $req->type)->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
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


    /////////////////////////// --------------- Transaction Methods Ends ---------- //////////////////////////



    /////////////////////////// --------------- Transaction Receive Methods start ---------- //////////////////////////
    //Show All Transaction Receive Details
    public function ShowTransactionReceive(){
        $transaction = Transaction_Main::where('tran_method','Receive')->where('tran_type','1')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '1')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('transaction.general.receive.transactionReceives', compact('transaction','groupes'));
    }//End Method

    /////////////////////////// --------------- Transaction Receive Methods Ends ---------- //////////////////////////
    
    
    
    
    /////////////////////////// --------------- Transaction Payment Methods start ---------- //////////////////////////
    //Show All Transaction Payment Details
    public function ShowTransactionPayment(){
        $transaction = Transaction_Main::where('tran_method','Payment')->where('tran_type','1')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '1')->whereIn('tran_method',["Payment",'Both'])->orderBy('added_at','asc')->get();
        return view('transaction.general.payment.transactionPayments', compact('transaction','groupes'));
    }//End Method


    /////////////////////////// --------------- Transaction Payment Methods Ends ---------- //////////////////////////




    /////////////////////////// --------------- Bank withdraw Methods Starts ---------- //////////////////////////
    //Show All Bank Withdraws
    public function ShowBankWithdraws(){
        $transaction = Transaction_Main::where('tran_method','Receive')->where('tran_type','4')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $heads = Transaction_Head::where('groupe_id', '4')->get();
        $tranwith = Transaction_With::where('user_type','Bank')->get();
        return view('transaction.bank.withdraw.bankWithdraws', compact('transaction','heads','tranwith'));
    }//End Method


    /////////////////////////// --------------- Bank Withdraw Methods Ends ---------- //////////////////////////



    /////////////////////////// --------------- Bank Deposit Methods Starts ---------- //////////////////////////
    //Show All Bank Deposits
    public function ShowBankDeposits(){
        $transaction = Transaction_Main::where('tran_method','Payment')->where('tran_type','4')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $heads = Transaction_Head::where('groupe_id', '3')->get();
        $tranwith = Transaction_With::where('user_type','Bank')->get();
        return view('transaction.bank.deposit.bankDeposits', compact('transaction','heads','tranwith'));
    }//End Method

    /////////////////////////// --------------- Bank Deposit Methods Ends ---------- //////////////////////////
}
