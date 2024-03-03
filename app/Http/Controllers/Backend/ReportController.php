<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction_Main;

class ReportController extends Controller
{
    ////////////////////////////// All Due & Filter $ Pagination //////////////////////////////

    public function PendingAllDue(){

        $alldue = Transaction_Main::where('due','>','0')->orderBy('id','DESC')->paginate(2);
        return view('reports.due_statement',compact('alldue'));

    }// End Method 

    Public function Filter(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $alldue = Transaction_Main::where('tran_date','>=',$start_date)
                                    // ->where('tran_date','<=',$end_date)
                                    ->paginate(2);
        return view('reports.due_statement',compact('alldue'));

    }//End Method

    //pagination
    public function Pagination(Request $request){

        $alldue = Transaction_Main::where('due','>','0')->orderBy('id','DESC')->paginate(2);
        return view('reports.pagi_due_statement',compact('alldue'))->render();

    }//End Method

    //Searching
    public function SearchDueStatement(Request $request){

        $alldue = Transaction_Main::where('invoice', 'like', '%'.$request->search_string.'%')
        // ->where('price', 'like', '%'.$request->search_string.'%')
        ->orderBy('id', 'desc')
        ->paginate(2);
        if($alldue->count() >= 1){
            return view('reports.pagi_due_statement',compact('alldue'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found',
            ]);
        }
    }//End Method

    //Pay All Due
    public function PendingAllDueAjax($id){

        $allduepay = Transaction_Main::findOrFail($id);
        return response()->json($allduepay);

    }// End Method  

    public function TransUpdateDue(Request $request){

        $trans_due_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $alltrans = Transaction_Main::findOrFail($trans_due_id);
        $maindue = $alltrans->due;
        $mainpay = $alltrans->payment;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;

        Transaction_Main::findOrFail($trans_due_id)->update([
            'due' => $paid_due,
            'payment' => $paid_pay, 
        ]);

         $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('pending.all.due')->with($notification);


    }// End Method 

    // Trans Details
    public function TransDetails($trans_id){

        $transDetails = Transaction_Main::where('id',$trans_id)->first();
        return view('reports.details_due_statement',compact('transDetails'));

    }// End Method 

    /////////////////////////////////////// For Client Due & Filter //////////////////////////

    public function ClientDueTransaction()
    {

        $clientDueTransactions = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'client');
        })->get();

        return view('reports.client_due_statement', compact('clientDueTransactions'));

    }//End Method

    Public function ClientFilter(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $clientDueTransactions = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'client');
        })->where('tran_date','>=',$start_date)->get();

        return view('reports.client_due_statement',compact('clientDueTransactions'));

    }//End Method
    

     /////////////////////////////////////// For Supplier Due & Filter //////////////////////////

    public function SupplierDueTransaction()
    {

        $supplierDueTransaction = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'supplier');
        })->get();

        return view('reports.supplier_due_statement', compact('supplierDueTransaction'));

    }//End Method

    Public function SupplierFilter(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $supplierDueTransaction = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'supplier');
        })->where('tran_date','>=',$start_date)->get();

        return view('reports.supplier_due_statement',compact('supplierDueTransaction'));
        
    }//End Method








}
