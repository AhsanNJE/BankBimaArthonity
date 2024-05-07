<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User_Info;
use App\Models\Transaction_Main;
use App\Models\Transaction_With;

class BankController extends Controller
{
    /////////////////////////// --------------- Bank Methods start---------- //////////////////////////
    //Show Banks
    public function ShowBanks(){
        $bank = User_Info::where('user_type','bank')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Bank')->get();
        return view('bank.banks', compact('bank','tranwith'));
    }//End Method


    //Show Bank Details
    public function ShowBankDetails(Request $req){
        $bank = User_Info::with('Location','Withs')->where('user_id', "=", $req->id)->first();
        $transaction = Transaction_Main::where('tran_user', "=", $req->id)->get();
        return response()->json([
            'data'=>view('bank.details', compact('bank','transaction'))->render(),
            "transaction"=> $transaction
        ]);
    }//End Method



    //Insert Bank
    public function InsertBanks(Request $req){
        $req->validate([
            "name" => 'required',
            "phone" => 'unique:user__infos,user_phone',
            "email" => 'unique:user__infos,user_email',
            "address" => 'required',
            "location" => 'required|numeric',
        ]);


        //generates Auto Increment Bank Id
        $latestEmployee = User_Info::where('user_type','bank')->orderBy('added_at','desc')->first();
        $id = ($latestEmployee) ? 'B' . str_pad((intval(substr($latestEmployee->user_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'B000000101';


        $bank = User_Info::insert([
            "user_id" => $id,
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_phone" => $req->phone,
            "user_email" => $req->email,
            "loc_id" => $req->location,
            "address" => $req->address,
            "user_type" => 'bank',
        ]);
        
        if($bank){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Bank
    public function EditBanks(Request $req){
        $bank = User_Info::with('Location')->findOrFail($req->id);
        $tranwith = Transaction_With::where('user_type','Bank')->get();
        return response()->json([
            'bank'=>$bank,
            'tranwith'=>$tranwith,
        ]);
    }//End Method



    //Update Bank
    public function UpdateBanks(Request $req){
        $bank = User_Info::findOrFail($req->id);

        $req->validate([
            "type" => 'required',
            "name" => 'required',
            "phone" => [Rule::unique('user__infos', 'user_phone')->ignore($bank->id)],
            "email" => [Rule::unique('user__infos', 'user_email')->ignore($bank->id)],
            "address" => 'required',
            "location" => 'required|numeric',
        ]);


        $update = User_Info::findOrFail($req->id)->update([
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_phone" => $req->phone,
            "user_email" => $req->email,
            "loc_id" => $req->location,
            "address" => $req->address,
            "updated_at" => now(),
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        } 
    }//End Method



    //Delete Banks
    public function DeleteBanks(Request $req){
        User_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Bank Pagination
    public function BankPagination(){
        $bank = User_Info::where('user_type','bank')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('bank.bankPagination', compact('bank'))->render(),
        ]);
    }//End Method



    // Search Bank by Name
    public function SearchBanks(Request $request){
        if($request->search != ""){
            $bank = User_Info::where('user_type','bank')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $bank = User_Info::where('user_type','bank')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        

        $paginationHtml = $bank->links()->toHtml();
        
        if($bank->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('bank.search', compact('bank'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Bank by Email
    public function SearchBankByEmail(Request $request){
        if($request->search != ""){
            $bank = User_Info::where('user_type','bank')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $bank = User_Info::where('user_type','bank')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $bank->links()->toHtml();
        
        if($bank->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('bank.search', compact('bank'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Bank by Contact
    public function SearchBankByContact(Request $request){
        if($request->search != ""){
            $bank = User_Info::where('user_type','bank')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $bank = User_Info::where('user_type','bank')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        

        $paginationHtml = $bank->links()->toHtml();
        
        if($bank->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('bank.search', compact('bank'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Bank by Location
    public function SearchBankByLocation(Request $request){
        if($request->search != ""){
            $bank = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','bank')
            ->paginate(15);
        }
        else{
            $bank = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','bank')
            ->paginate(15);
        }
        

        $paginationHtml = $bank->links()->toHtml();
        
        if($bank->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('bank.search', compact('bank'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Bank by Address
    public function SearchBankByAddress(Request $request){
        if($request->search != ""){
            $bank = User_Info::where('user_type','bank')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $bank = User_Info::where('user_type','bank')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $bank->links()->toHtml();
        
        if($bank->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('bank.search', compact('bank'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    /////////////////////////// --------------- Bank Methods end---------- //////////////////////////
}
