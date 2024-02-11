<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Client_Info;

class ClientController extends Controller
{
    /////////////////////////// --------------- Client Methods start---------- //////////////////////////
    //Show Clients
    public function ShowClients(){
        $client = Client_Info::orderBy('added_at','desc')->paginate(15);
        return view('client.clients', compact('client'));
    }//End Method



    //Insert Client
    public function InsertClients(Request $request){
        $request->validate([
            "clientName" => 'required',
            "contact" => 'required|numeric|unique:client__infos,client_contact',
            "email" => 'required|email',
            "address" => 'required',
        ]);

        $client = Client_Info::insert([
            "client_name" => $request->clientName,
            "client_contact" => $request->contact,
            "client_email" => $request->email,
            "client_address" => $request->address,
        ]);
        
        if($client){
            return response()->json([
                'status'=>'success',
            ]); 
        } 
    }//End Method



    //Edit Client
    public function EditClients($id){
        $client = Client_Info::findOrFail($id);
        return response()->json([
            'client'=>$client,
        ]);
    }//End Method



    //Update Client
    public function UpdateClients(Request $request,$id){
        $client = Client_Info::findOrFail($id);

        $request->validate([
            "clientName" => 'required',
            "contact" => ['required','numeric',Rule::unique('client__infos', 'client_contact')->ignore($client->id)],
            "email" => 'required|email',
            "address" => 'required',
        ]);


        $update = Client_Info::findOrFail($id)->update([
            "client_name" => $request->clientName,
            "client_contact" => $request->contact,
            "client_email" => $request->email,
            "client_address" => $request->address,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        } 
    }//End Method



    //Delete Clients
    public function DeleteClients($id){
        Client_Info::findOrFail($id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Client Pagination
    public function ClientPagination(){
        $client = Client_Info::orderBy('added_at','desc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('client.clientPagination', compact('client'))->render(),
        ]);
    }//End Method



    //Search Client by Name
    public function SearchClients(Request $request){
        $client = Client_Info::where('client_name', 'like', '%'.$request->search.'%')
        ->orWhere('id', 'like','%'.$request->search.'%')
        ->orderBy('client_name','asc')
        ->paginate(15);

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
        $client = Client_Info::where('client_email', 'like', '%'.$request->search.'%')
        ->orderBy('client_email','asc')
        ->paginate(15);

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
        $client = Client_Info::where('client_contact', 'like', '%'.$request->search.'%')
        ->orderBy('client_contact','asc')
        ->paginate(15);

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



    //Search Client by Address
    public function SearchClientByAddress(Request $request){
        $client = Client_Info::where('client_address', 'like', '%'.$request->search.'%')
        ->orderBy('client_address','asc')
        ->paginate(15);

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
