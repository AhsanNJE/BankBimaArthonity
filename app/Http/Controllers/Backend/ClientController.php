<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Client_Info;
use App\Models\User_Info;

class ClientController extends Controller
{
    /////////////////////////// --------------- Client Methods start---------- //////////////////////////
    //Show Clients
    public function ShowClients(){
        $client = User_Info::where('user_type','client')->orderBy('added_at','desc')->paginate(15);
        return view('client.clients', compact('client'));
    }//End Method



    //Insert Client
    public function InsertClients(Request $req){
        $req->validate([
            "name" => 'required',
            "type" => 'required',
            "phone" => 'required|numeric|unique:user__infos,user_phone',
            "email" => 'required|email|unique:user__infos,user_email',
            "gender" => 'required',
            "location" => 'required|numeric',
        ]);


        //generates Auto Increment Client Id
        $latestEmployee = User_Info::where('user_type','client')->orderBy('added_at','desc')->first();
        $id = ($latestEmployee) ? 'C' . str_pad((intval(substr($latestEmployee->user_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'C000000101';


        $client = User_Info::insert([
            "user_id" => $id,
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_phone" => $req->phone,
            "user_email" => $req->email,
            "gender" => $req->gender,
            "loc_id" => $req->location,
            "address" => $req->address,
            "user_type" => 'client',
        ]);
        
        if($client){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Client
    public function EditClients(Request $req){
        $client = User_Info::with('Location')->findOrFail($req->id);
        return response()->json([
            'client'=>$client,
        ]);
    }//End Method



    //Update Client
    public function UpdateClients(Request $req){
        $client = User_Info::findOrFail($req->id);

        $req->validate([
            "type" => 'required',
            "name" => 'required',
            "phone" => ['required','numeric',Rule::unique('user__infos', 'user_phone')->ignore($client->id)],
            "email" => ['required','email',Rule::unique('user__infos', 'user_email')->ignore($client->id)],
            "gender" => 'required',
            "location" => 'required|numeric',
        ]);


        $update = User_Info::findOrFail($req->id)->update([
            "tran_user_type" => $req->type,
            "user_name" => $req->name,
            "user_phone" => $req->phone,
            "user_email" => $req->email,
            "gender" => $req->gender,
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



    //Delete Clients
    public function DeleteClients(Request $req){
        User_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Client Pagination
    public function ClientPagination(){
        $client = User_Info::where('user_type','client')->orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('client.clientPagination', compact('client'))->render(),
        ]);
    }//End Method



    // Search Client by Name
    public function SearchClients(Request $request){
        if($request->search != ""){
            $client = User_Info::where('user_type','client')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $client = User_Info::where('user_type','client')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        

        $paginationHtml = $client->links()->toHtml();
        
        if($client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('client.searchClient', compact('client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Email
    public function SearchClientByEmail(Request $request){
        if($request->search != ""){
            $client = User_Info::where('user_type','client')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $client = User_Info::where('user_type','client')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $client->links()->toHtml();
        
        if($client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('client.searchClient', compact('client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Contact
    public function SearchClientByContact(Request $request){
        if($request->search != ""){
            $client = User_Info::where('user_type','client')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $client = User_Info::where('user_type','client')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        

        $paginationHtml = $client->links()->toHtml();
        
        if($client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('client.searchClient', compact('client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Client by Location
    public function SearchClientByLocation(Request $request){
        if($request->search != ""){
            $client = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','client')
            ->paginate(15);
        }
        else{
            $client = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','client')
            ->paginate(15);
        }
        

        $paginationHtml = $client->links()->toHtml();
        
        if($client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('client.searchClient', compact('client'))->render(),
                'paginate' => $paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    //Search Client by Address
    public function SearchClientByAddress(Request $request){
        if($request->search != ""){
            $client = User_Info::where('user_type','client')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $client = User_Info::where('user_type','client')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $client->links()->toHtml();
        
        if($client->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('client.searchClient', compact('client'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    /////////////////////////// --------------- Inventory Client Methods end---------- //////////////////////////
}
