<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction_Main;
use App\Models\Transaction_Detail;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    ////////////////////////////// All Due & Filter $ Pagination //////////////////////////////

    public function PendingAllDue()
    {

        $alldue = Transaction_Main::where('due', '>', '0')->orderBy('id', 'DESC')->paginate(2);
        return view('reports.due_statement', compact('alldue'));
    } // End Method 

    public function Filter(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $alldue = Transaction_Main::where('tran_date', '>=', $start_date)
            // ->where('tran_date','<=',$end_date)
            ->paginate(2);
        return view('reports.due_statement', compact('alldue'));
    } //End Method

    //pagination
    public function Pagination(Request $request)
    {

        $alldue = Transaction_Main::where('due', '>', '0')->orderBy('id', 'DESC')->paginate(2);
        return view('reports.pagi_due_statement', compact('alldue'))->render();
    } //End Method

    //Searching
    public function SearchDueStatement(Request $request)
    {

        $alldue = Transaction_Main::with('User')
            ->whereHas('User', function ($query) use ($request) {
                $query->where('user_type', 'employee');
                $query->where('user_name', 'like', '%' . $request->search_string . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(2);

        if ($alldue->count() >= 1) {
            return view('reports.pagi_due_statement', compact('alldue'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    } //End Method

    //Pay All Due
    public function PendingAllDueAjax($id)
    {

        $allduepay = Transaction_Main::findOrFail($id);
        return response()->json($allduepay);
    } // End Method  

    public function TransUpdateDue(Request $request)
    {

        $trans_due_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $alltrans = Transaction_Main::findOrFail($trans_due_id);
        $maindue = $alltrans->due;
        $mainduecol = $alltrans->due_col;

        $paid_due = $maindue - $due_amount;
        $paidduecol = $mainduecol + $due_amount;

        Transaction_Main::findOrFail($trans_due_id)->update([
            'due' => $paid_due,
            'due_col' => $paidduecol,
        ]);

        $notification = array(
            'message' => 'Due Amount Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pending.all.due')->with($notification);
    } // End Method 

    // Trans Details
    public function TransDetails($trans_id)
    {

        $transDetails = Transaction_Main::where('id', $trans_id)->first();
        return view('reports.details_due_statement', compact('transDetails'));
    } // End Method 

    // Invoice
    public function TransInvoice($transinvoice_id)
    {
        $transDetailsInvoice = Transaction_Detail::where('tran_id', $transinvoice_id)->get();
        $transSum = Transaction_Detail::where('tran_id', $transinvoice_id)->sum('tot_amount');

        $transMainInvoice = Transaction_Main::where('tran_id', $transinvoice_id)->first();
        return view('reports.invoice_due_statement', compact('transMainInvoice', 'transDetailsInvoice', 'transSum'));
    } // End Method 

    //PDF Invoice
    public function TransPdfInvoice($transpdfinvoice_id)
    {

        $transDetailsInvoice = Transaction_Detail::where('tran_id', $transpdfinvoice_id)->get();
        $transSum = Transaction_Detail::where('tran_id', $transpdfinvoice_id)->sum('tot_amount');

        $transMainInvoice = Transaction_Main::where('tran_id', $transpdfinvoice_id)->first();

        $pdf = Pdf::loadView('reports.invoice_pdf', compact('transMainInvoice', 'transDetailsInvoice','transSum'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),

        ]);
        return $pdf->download('invoice.pdf');
    } // End Method 

    /////////////////////////////////////// For Client Due & Filter //////////////////////////

    public function ClientDueTransaction()
    {

        $clientDueTransactions = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'client');
        })->get();

        return view('reports.client_due_statement', compact('clientDueTransactions'));
    } //End Method

    public function ClientFilter(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $clientDueTransactions = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'client');
        })->where('tran_date', '>=', $start_date)->get();

        return view('reports.client_due_statement', compact('clientDueTransactions'));
    } //End Method


    /////////////////////////////////////// For Supplier Due & Filter //////////////////////////

    public function SupplierDueTransaction()
    {

        $supplierDueTransaction = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'supplier');
        })->get();

        return view('reports.supplier_due_statement', compact('supplierDueTransaction'));
    } //End Method

    public function SupplierFilter(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $supplierDueTransaction = Transaction_Main::whereHas('User', function ($query) {
            $query->where('user_type', 'supplier');
        })->where('tran_date', '>=', $start_date)->get();

        return view('reports.supplier_due_statement', compact('supplierDueTransaction'));
    } //End Method




    // Show Report By groupe 
    public function ReportByGroupe(){
        //get unique transaction id where tran_type receive
        $receive_id = Transaction_Detail::where('tran_type', 'receive')
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');
        
        //get unique transaction id where tran_type payment
        $payment_id = Transaction_Detail::where('tran_type', 'payment')
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');

        
        $receive = [];
        $receive_main = [];
        foreach($receive_id as $key => $tranid){
            $receive[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $receive_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }
        
        $payment = [];
        $payment_main = [];
        foreach($payment_id as $key => $tranid){
            $payment[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $payment_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }
        return view('reports.report_by_groupe.report_by_groupe', compact('receive','payment','receive_main','payment_main'));
    } //End Method


    // Report Invoice Details
    public function ReportInvoiceDetails(Request $req)
    {
        $transDetailsInvoice = Transaction_Detail::where('tran_id', $req->id)->get();
        $transSum = Transaction_Detail::where('tran_id', $req->id)->sum('tot_amount');
        $transMainInvoice = Transaction_Main::where('tran_id', $req->id)->first();

        return response()->json([
            'status'=>'success',
            'data'=> view('reports.report_by_groupe.details', compact('transMainInvoice', 'transDetailsInvoice', 'transSum'))->render(),
        ]);
    } // End Method 




    // Show Report By groupe 
    public function SearchReportByGroupeDate(Request $req){
        //get unique transaction id where tran_type receive
        $receive_id = Transaction_Detail::where('tran_type', 'receive')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');
        
        //get unique transaction id where tran_type payment
        $payment_id = Transaction_Detail::where('tran_type', 'payment')
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');

        
        $receive = [];
        $receive_main = [];
        foreach($receive_id as $key => $tranid){
            $receive[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $receive_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }
        
        $payment = [];
        $payment_main = [];
        foreach($payment_id as $key => $tranid){
            $payment[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $payment_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }

        
        if($receive->count() > 0 || $payment->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('reports.report_by_groupe.search', compact('receive','payment','receive_main','payment_main'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    } //End Method


}
