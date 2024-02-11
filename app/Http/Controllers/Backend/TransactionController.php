<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Transaction_Groupe;
use App\Models\Transaction_Head;


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
            foreach($groupes as $groupe) {
                $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$groupe->id.'">'.$groupe->tran_groupe_name.'</li>';
            }
        }
        else{
            $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
        }
        return $list;
    }//End Method




    //Insert Transaction Groupes
    public function InsertTransactionGroupes(Request $req){
        $req->validate([
            "groupeName" => 'required|unique:transaction__groupes,tran_groupe_name'
        ]);

        Transaction_Groupe::insert([
            "tran_groupe_name" => $req->groupeName,
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
        ]);

        $update = Transaction_Groupe::findOrFail($req->id)->update([
            "tran_groupe_name" => $req->groupeName,
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

    /////////////////////////// --------------- Transaction Groupes Table Methods start ---------- //////////////////////////




    /////////////////////////// --------------- Transaction Heads Table Methods start ---------- //////////////////////////
    
    //Show All Transaction Heads
    public function ShowTransactionHeads(){
        $heads = Transaction_Head::orderBy('added_at','desc')->paginate(15);
        return view('transaction.transactionHead.transactionHeads', compact('heads'));
    }//End Method



    //Get Transaction Heads By Name And Groupe
    public function GetTransactionHeadsByGroupe(Request $req){
        if($req->department != ""){
            $heads = Transaction_Head::where('tran_head_name', 'like', '%'.$req->head.'%')
            ->where('groupe_id', $req->groupe)
            ->orderBy('tran_head_name','asc')
            ->take(10)
            ->get();

            if($heads->count() > 0){
                $list = "";
                foreach($heads as $head) {
                    $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$head->id.'">'.$head->tran_head_name.'</li>';
                }
            }
            else{
                $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
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
        $heads = Transaction_Head::with('Groupe')->findOrFail($req->id);
        return response()->json([
            'heads'=>$heads,
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



    /////////////////////////// --------------- Transaction Heads Table Methods start ---------- //////////////////////////

}
