<?php

namespace App\Http\Controllers\Backend;

use App\Models\User_Info;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Head;
use App\Models\Transaction_Main;
use App\Models\Transaction_Type;
use App\Models\Transaction_With;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Groupe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Party_Payment_Receive;
use App\Models\Transaction_With_Groupe;

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
        ->where('tran_method', 'like', '%'.$req->method.'%')
        ->where('tran_type', 'like', '%'.$req->type.'%')
        ->where('user_type', 'like', '%'.$req->user.'%')
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
        ->where('tran_groupe_type', 'like', '%'.$req->type.'%')
        ->where('tran_method', 'like', '%'.$req->method.'%')
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



    /////////////////////////// --------------- Tran With Groupe Table Methods start ---------- //////////////////////////
    //Show All TranWith Groupe
    public function ShowTranWithGroupe(){
        $withgroupes = Transaction_With_Groupe::orderBy('added_at','asc')->paginate(15);
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        $tranwith = Transaction_With::orderBy('added_at','asc')->get();
        return view('transaction.tran_with_groupe.tranWithGroupes', compact('withgroupes','groupes','tranwith'));
    }//End Method



    //Insert TranWith Groupe
    public function InsertTranWithGroupe(Request $req){
        $req->validate([
            "with" => 'required|numeric',
            "groupe" => 'required|numeric',
        ]);

        Transaction_With_Groupe::insert([
            "with_id" => $req->with,
            "groupe_id" => $req->groupe,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit TranWith Groupe
    public function EditTranWithGroupe(Request $req){
        $tranwithgroupes = Transaction_With_Groupe::findOrFail($req->id);
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        $tranwith = Transaction_With::orderBy('added_at','asc')->get();
        return response()->json([
            'tranwithgroupes'=>$tranwithgroupes,
            'groupes'=>$groupes,
            'tranwith'=>$tranwith
        ]);
    }//End Method



    //Update TranWith Groupe
    public function UpdateTranWithGroupe(Request $req){
        $tranwithgroupe = Transaction_With_Groupe::findOrFail($req->id);

        $req->validate([
            "with" => 'required|numeric',
            "groupe" => 'required|numeric',
        ]);

        $update = Transaction_With_Groupe::findOrFail($req->id)->update([
            "with_id" => $req->with,
            "groupe_id" => $req->groupe,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete TranWith Groupe
    public function DeleteTranWithGroupe(Request $req){
        Transaction_With_Groupe::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    // TranWith Groupe Pagination
    public function TranWithGroupePagination(){
        $withgroupes = Transaction_With_Groupe::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('transaction.tran_with_groupe.tranWithGroupePagination', compact('withgroupes'))->render(),
        ]);
    }//End Method



    //TranWith Groupe Search By With
    public function SearchTranWithGroupeByWith(Request $req){
        $withgroupes = Transaction_With_Groupe::with('Withs')
        ->whereHas('Withs', function ($query) use ($req) {
            $query->where('tran_with_name', 'like', '%' . $req->search . '%');
            $query->orderBy('tran_with_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $withgroupes->links()->toHtml();
        
        if($withgroupes->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.tran_with_groupe.search', compact('withgroupes'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //TranWith Groupe Search By Groupe
    public function SearchTranWithGroupeByGroupe(Request $req){
        $withgroupes = Transaction_With_Groupe::with('Groupe')
        ->whereHas('Groupe', function ($query) use ($req) {
            $query->where('tran_groupe_name', 'like', '%' . $req->search . '%');
            $query->orderBy('tran_groupe_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $withgroupes->links()->toHtml();
        
        if($withgroupes->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('transaction.tran_with_groupe.search', compact('withgroupes'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Tran With Groupe Table Methods start ---------- //////////////////////////





    /////////////////////////// --------------- Transaction Heads Table Methods start ---------- //////////////////////////
    //Show All Transaction Heads
    public function ShowTransactionHeads(){
        $groupes = Transaction_Groupe::orderBy('added_at','asc')->get();
        $heads = Transaction_Head::orderBy('added_at','asc')->paginate(15);
        return view('transaction.transactionHead.transactionHeads', compact('heads', 'groupes'));
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
    
    // Get Transaction Id By Transaction Method And Type 
    public function GetTransactionId(Request $req){
        $prefixes = [
            '1' => ['Receive' => 'REC', 'Payment' => 'PAY'],
            '2' => ['Receive' => 'PPR', 'Payment' => 'PPP'],
            '3' => ['Receive' => 'PRR', 'Payment' => 'PRP'],
            '4' => ['Receive' => 'BMW', 'Payment' => 'BMD'],
            '5' => ['Issue' => 'ITR', 'Purchase' => 'ITP', 'Negative' => 'INA', 'Positive' => 'IPA', "Supplier Return" => 'ISR', "Client Return"=>'ICR'],
            '6' => ['Issue' => 'PTR', 'Purchase' => 'PTP', 'Negative' => 'PNA', 'Positive' => 'PPA', "Supplier Return" => 'PSR', "Client Return"=>'PCR'],
            '7' => ['Receive' => 'MTR', 'Payment' => 'MTP'],
        ];
    
        if ($req->type && isset($prefixes[$req->type])) {
            $prefix = $prefixes[$req->type][$req->method] ?? null;
            if ($prefix) {
                $transaction = Transaction_Main::where('tran_type', $req->type)
                    ->where('tran_method', $req->method)
                    ->latest('tran_id')
                    ->first();
    
                $id = ($transaction) ? $prefix . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : $prefix . '000000001';
    
                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid request parameters',
        ]);
    }//End Method



    // Get Transaction With By Transaction Method And Type
    public function GetTransactionWith(Request $req){
        if($req->type == null){
            $tranwith = Transaction_With::whereIn('tran_method', [$req->method, 'Both'])->where('user_type', $req->user)->get();
        }
        else{
            $tranwith = Transaction_With::whereIn('tran_method', [$req->method, 'Both'])->where('tran_type',$req->type)->get();
        }
        
        return response()->json([
            'status' => 'success',
            'tranwith' => $tranwith,
        ]);
    }//End Method


    
    // Get Transaction User By Transaction User Type
    public function GetTransactionUser(Request $req){
        if($req->within == "1"){
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->whereIn('tran_user_type', $req->tranUserType)
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();

            if($users->count() > 0){
                $list = "";
                foreach($users as $index => $user) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$user->user_id.'"  data-with="'.$user->tran_user_type.'">'.$user->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else{
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->where('tran_user_type', $req->tranUserType)
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();


            if($users->count() > 0){
                $list = "";
                foreach($users as $index => $user) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$user->user_id.'" data-with="'.$user->tran_user_type.'">'.$user->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
    }//End Method




    // Get Transaction Groupe By Transaction With
    public function GetTransactionGroupeByWith(Request $req){
        $groupes = Transaction_With_Groupe::select('groupe_id')->whereIn('with_id', $req->withs)->groupBy('groupe_id')->get();

        return response()->json([
            'status' => 'success',
            'groupes' => $groupes,
        ]);
    }//End Method





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




    // Print Transaction Details
    public function PrintTransactionDetails(Request $req)
    {
        $transDetailsInvoice = Transaction_Detail::
                                select(
                                    'tran_head_id', 
                                    'amount',
                                    DB::raw('SUM(quantity) as sum_quantity'),
                                    DB::raw('SUM(quantity_issue) as sum_quantity_issue'),
                                    DB::raw('SUM(tot_amount) as sum_tot_amount'),
                                    DB::raw('COUNT(*) as count')
                                )
                                ->where('tran_id', $req->id)
                                ->groupBy('tran_head_id','amount')
                                ->get();
        $transactionMain = Transaction_Main::where('tran_id', $req->id)->first();

        return response()->json([
            'status'=>'success',
            'data'=> view('transaction.details', compact('transactionMain', 'transDetailsInvoice'))->render(),
        ]);
    } // End Method 




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
                "expiry_date" => $req->expiry == null ? null :$req->expiry,
            ]);
    
            return response()->json([
                'status'=>'success',
            ]);
        }

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
        ]);

        return response()->json(['status' => 'success']);
    }//End Method



    //Edit Transaction Main
    public function EditTransactionMain(Request $req){
        $transaction = Transaction_Main::with('Location','User','withs','Store')->where('tran_id', $req->id )->first();
        return response()->json([
            'transaction'=>$transaction,
        ]);
    }//End Method


    //Edit Transaction Details
    public function EditTransactionDetails(Request $req){
        $transaction = Transaction_Detail::with('Head', 'Unit')->findOrFail($req->id);
        return response()->json([
            'transaction'=>$transaction,
        ]);
    }//End Method



    //Update Transaction Details
    public function UpdateTransactionDetails(Request $req){
        if($req->dId != ""){
            $transaction = Transaction_Detail::findOrFail($req->id);
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
                "expiry_date" => $req->expiry,
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
                    "expiry_date" => $req->expiry,
                ]);
        
                return response()->json([
                    'status'=>'success',
                ]);  
            }
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


        if($req->totalDiscount > $req->amountRP){
            return response()->json([
                'errors' => [
                    'message' => ["Discount amount can't be bigger than total amount"]
                ]
            ], 422);
        }
        if($req->totalDiscount < 0){
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


        $receive = ($req->method === 'Receive' || $req->method === 'Issue') ? $req->advance : null;
        $payment = ($req->method === 'Payment' || $req->method === 'Purchase') ? $req->advance : null;

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
        $transaction = Transaction_Main::where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')->paginate(15);
        
        return view('transaction.general.transactionPagination', compact('transaction'));
    }//End Method



    // Get Transaction Details by Date Range
    public function ShowTransactionByDate(Request $req){
        $transaction = Transaction_Main::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method', $req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $transaction->links()->toHtml();

        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search'
        ];
    
        $view = $viewMapping['1']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('transaction'))->render(),
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
        $transaction = Transaction_Main::where('tran_id', "like", '%'. $req->search .'%')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_id','asc')
        ->paginate(15);
        
        $paginationHtml = $transaction->links()->toHtml();


        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search'
        ];
    
        $view = $viewMapping['1']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }
        
        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('transaction'))->render(),
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
        $transaction = Transaction_Main::with('User')
        ->whereHas('User', function ($query) use ($req) {
            $query->where('user_name', 'like', '%'.$req->search.'%');
            $query->orderBy('user_name','asc');
        })
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->paginate(15);
        

        $paginationHtml = $transaction->links()->toHtml();

        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search'
        ];
    
        $view = $viewMapping['1']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }

        if($transaction->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('transaction'))->render(),
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
    // Show All Bank Withdraws
    public function ShowBankWithdraws(){
        $transaction = Transaction_Main::where('tran_method','Receive')->where('tran_type','4')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $heads = Transaction_Head::where('groupe_id', '4')->get();
        $tranwith = Transaction_With::where('user_type','Bank')->get();
        return view('transaction.bank.withdraw.bankWithdraws', compact('transaction','heads','tranwith'));
    }//End Method


    // Update Bank Transaction
    public function UpdateBankTransactions(Request $req){
        $transaction = Transaction_Main::findOrFail($req->id);
        $req->validate([
            "user"  => 'required',
            "locations"  => 'required|numeric',
            "amount"  => 'required|numeric',
        ]);

        $receive = $req->method === 'Receive' ? $req->amount : null;
        $payment = $req->method === 'Payment' ? $req->amount : null;

        $update = Transaction_Main::findOrFail($req->id)->update([
            "tran_user" => $req->user,
            "tran_type_with" => $req->withs,
            "loc_id" => $req->locations,
            "bill_amount" => $req->amount,
            "net_amount" => $req->amount,
            "receive" => $receive,
            "payment" => $payment,
            "updated_at" => now()
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }


    // Delete Transaction Main
    public function DeleteBankWithdraws(Request $req){
        Transaction_Main::where("tran_id", $req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
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


    //Delete Transaction Main
    public function DeleteBankDeposits(Request $req){
        Transaction_Main::where("tran_id", $req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method

    /////////////////////////// --------------- Bank Deposit Methods Ends ---------- //////////////////////////



    /////////////////////////// --------------- Adjustment Methods start ---------- //////////////////////////


    // Print Transaction Details
    public function PrintPATransactionDetails(Request $req)
    {
        $transDetailsInvoice = Transaction_Detail::where('tran_id', $req->id)->get();
        $transSum = Transaction_Detail::where('tran_id', $req->id)->sum('tot_amount');
        $transactionMain = Transaction_Main::where('tran_id', $req->id)->first();

        return response()->json([
            'status'=>'success',
            'data'=> view('transaction.details', compact('transactionMain', 'transDetailsInvoice', 'transSum'))->render(),
        ]);
    } // End Method 


    //Show All Positive Adjustment Details
    public function ShowPositiveAdjustment(){
        $adjust = Transaction_Detail::where('tran_method','Positive')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '1')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.positive_adjustment.positiveAdjustments', compact('adjust','groupes'));
    }//End Method


    //Show All Negative Adjustment Details
    public function ShowNegativeAdjustment(){
        $adjust = Transaction_Detail::where('tran_method','Negative')->where('tran_type','5')->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])->orderBy('tran_date','asc')->paginate(15);
        $groupes = Transaction_Groupe::where('tran_groupe_type', '1')->whereIn('tran_method',["Receive",'Both'])->orderBy('added_at','asc')->get();
        return view('inventory.negative_adjustment.negativeAdjustments', compact('adjust','groupes'));
    }//End Method

    //Insert Transaction Details
    public function InsertAdjustment(Request $req){
        $req->validate([
            "method" => 'required',
            "store" => 'required|numeric',
            "type" => 'required',
            "groupe" => 'required',
            "product" => 'required',
        ]);

        $adjust = Transaction_Detail::where('tran_id', $req->tranId)
        ->where('tran_head_id', $req->product)
        ->get();


        $heads = Transaction_Head::where('id',$req->product)->first();


        $prefixes = [
            '5' => ['Negative' => 'INA', 'Positive' => 'IPA'],
            '6' => ['Negative' => 'PNA', 'Positive' => 'PPA'],
        ];
    
        if ($req->type && isset($prefixes[$req->type])) {
            $prefix = $prefixes[$req->type][$req->method] ?? null;
            if ($prefix) {
                $transaction = Transaction_Detail::where('tran_type', $req->type)
                    ->where('tran_method', $req->method)
                    ->latest('tran_id')
                    ->first();
    
                $id = ($transaction) ? $prefix . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : $prefix . '000000001';
    
            }
        }


        Transaction_Detail::insert([
            "tran_id" => $id,
            "store_id" => $req->store,
            "tran_type" => $req->type,
            "tran_method" => $req->method,
            "tran_groupe_id" => $req->groupe,
            "tran_head_id" => $req->product,
            "quantity" => $req->quantity,
        ]);

        return response()->json([
            'status'=>'success',
        ]);

    }//End Method




    //Edit Transaction Details
    public function EditAdjustment(Request $req){

        $adjust = Transaction_Detail::where('tran_id', $req->tranId)
        ->where('tran_head_id', $req->product)
        ->get();


        $heads = Transaction_Head::where('id',$req->product)->first();

        $adjust = Transaction_Detail::with('Store','Head')->findOrFail($req->id);
        return response()->json([
            'adjust'=>$adjust,
        ]);
    }//End Method



    //Update Transaction Details
    public function UpdateAdjustment(Request $req){
        
        $req->validate([
            "method" => 'required',
            "store" => 'required|numeric',
            "type" => 'required',
            "groupe" => 'required',
            "product" => 'required',
        ]);

        $adjust = Transaction_Detail::where('tran_id', $req->tranId)
        ->where('tran_head_id', $req->product)
        ->get();


        $heads = Transaction_Head::where('id',$req->product)->first();
        
        $update = Transaction_Detail::findOrFail($req->id)->update([
            "tran_id" => $id,
            "store_id" => $req->store,
            "tran_type" => $req->type,
            "tran_method" => $req->method,
            "tran_groupe_id" => $req->groupe,
            "tran_head_id" => $req->product,
            "quantity" => $req->quantity,
            "updated_at" => now()
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
            }
            
        
    }//End Method

    //Delete Transaction Details
    public function DeleteAdjustment(Request $req){
        Transaction_Detail::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    //Adjustment Pagination
    public function AdjustmentPagination(Request $req){
        $adjust = Transaction_Detail::where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')->paginate(15);
        
        return view('inventory.positive_adjustment.adjustmentPagination', compact('adjust'));
    }//End Method



    // Get Adjustment Details by Date Range
    public function ShowAdjustmentByDate(Request $req){
        $adjust = Transaction_Detail::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method', $req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $adjust->links()->toHtml();

        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search',
            '7' => 'inventory.searchAdjustment'
        ];
    
        $view = $viewMapping['7']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }
        
        if($adjust->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('adjust'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Get Adjustment by TranId
    public function SearchAdjustmentByTranId(Request $req){
        $adjust = Transaction_Detail::where('tran_id', "like", '%'. $req->search .'%')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->orderBy('tran_id','asc')
        ->paginate(15);
        
        $paginationHtml = $adjust->links()->toHtml();


        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search',
            '7' => 'inventory.searchAdjustment'
        ];
    
        $view = $viewMapping['7']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }
        
        if($adjust->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('adjust'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    
    // Get Adjustment by Product
    public function SearchAdjustmentByProduct(Request $req){
        $adjust = Transaction_Detail::with('Head')
        ->whereHas('Head', function ($query) use ($req) {
            $query->where('tran_head_name', 'like', '%'.$req->search.'%');
            $query->orderBy('tran_head_name','asc');
        })
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->where('tran_method',$req->method)
        ->where('tran_type', $req->type)
        ->paginate(15);
        

        $paginationHtml = $adjust->links()->toHtml();

        $viewMapping = [
            '1' => 'transaction.general.search',
            '2' => 'party_payment.search',
            '4' => 'transaction.bank.search',
            '5' => 'inventory.purchase.search',
            '6' => 'transaction.pharmacy.search',
            '7' => 'inventory.searchAdjustment'
        ];
    
        $view = $viewMapping['7']; 
    
        if (isset($viewMapping[$req->type])) {
            $view = $viewMapping[$req->type];
        }

        if($adjust->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view($view, compact('adjust'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]);
        }
    }//End Method


    // Get Transaction Id By Transaction Method And Type 
    public function GetAdjustmentId(Request $req){
        $prefixes = [
            '5' => ['Negative' => 'INA', 'Positive' => 'IPA'],
            '6' => ['Negative' => 'PNA', 'Positive' => 'PPA'],
        ];
    
        if ($req->type && isset($prefixes[$req->type])) {
            $prefix = $prefixes[$req->type][$req->method] ?? null;
            if ($prefix) {
                $transaction = Transaction_Main::where('tran_type', $req->type)
                    ->where('tran_method', $req->method)
                    ->latest('tran_id')
                    ->first();
    
                $id = ($transaction) ? $prefix . str_pad((intval(substr($transaction->tran_id, 3)) + 1), 9, '0', STR_PAD_LEFT) : $prefix . '000000001';
    
                return response()->json([
                    'status' => 'success',
                    'id' => $id,
                ]);
            }
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid request parameters',
        ]);
    }//End Method



    // Get Transaction With By Transaction Method And Type
    public function GetAdjustmentWith(Request $req){
        if($req->type == null){
            $tranwith = Transaction_With::whereIn('tran_method', [$req->method, 'Both'])->where('user_type', $req->user)->get();
        }
        else{
            $tranwith = Transaction_With::whereIn('tran_method', [$req->method, 'Both'])->where('tran_type',$req->type)->get();
        }
        
        return response()->json([
            'status' => 'success',
            'tranwith' => $tranwith,
        ]);
    }//End Method


    
    // Get Transaction User By Transaction User Type
    public function GetAdjustmentGroupeByWith(Request $req){
        if($req->within == "1"){
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->whereIn('tran_user_type', $req->tranUserType)
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();

            if($users->count() > 0){
                $list = "";
                foreach($users as $index => $user) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$user->user_id.'"  data-with="'.$user->tran_user_type.'">'.$user->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else{
            $users = User_Info::where('user_name', 'like', '%'.$req->tranUser.'%')
            ->where('tran_user_type', $req->tranUserType)
            ->orderBy('user_name','asc')
            ->take(10)
            ->get();


            if($users->count() > 0){
                $list = "";
                foreach($users as $index => $user) {
                    $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$user->user_id.'" data-with="'.$user->tran_user_type.'">'.$user->user_name.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
    }//End Method




    // Get Transaction Groupe By Transaction With
    public function GetAdjustmentProduct(Request $req){
        $groupes = Transaction_With_Groupe::select('groupe_id')->whereIn('with_id', $req->withs)->groupBy('groupe_id')->get();

        return response()->json([
            'status' => 'success',
            'groupes' => $groupes,
        ]);
    }//End Method





    //Get Inserted Transacetion Grid By Transaction Id
    public function GetAdjustmentGrid(Request $request){
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





    /////////////////////////// --------------- Adjustment Methods Ends ---------- //////////////////////////
}
