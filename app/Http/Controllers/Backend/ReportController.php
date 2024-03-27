<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction_Head;
use App\Models\Transaction_Main;
use App\Models\Transaction_Detail;
use App\Models\Transaction_Groupe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
                $query->whereIn('user_type', ['employee', 'supplier', 'client']);
                // ->orWhere('user_type', 'client')
                // ->orWhere('user_type', 'supplier');
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

        $transDetailsPdfInvoice = Transaction_Detail::where('tran_id', $transpdfinvoice_id)->get();
        $transPdfSum = Transaction_Detail::where('tran_id', $transpdfinvoice_id)->sum('tot_amount');

        $transMainPdfInvoice = Transaction_Main::where('tran_id', $transpdfinvoice_id)->first();

        $pdf = Pdf::loadView('reports.invoice_pdf', compact('transMainPdfInvoice', 'transDetailsPdfInvoice','transPdfSum'))->setPaper('a4')->setOption([
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
        $receive_id = Transaction_Detail::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');
        
        // //get unique transaction id where tran_type payment
        // $payment_id = Transaction_Detail::where('tran_type', 'payment')
        // ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        // ->orderBy('tran_date','asc')
        // ->distinct('tran_id')
        // ->pluck('tran_id');

        
        $receive = [];
        $receive_main = [];
        foreach($receive_id as $key => $tranid){
            $receive[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $receive_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }
        
        // $payment = [];
        // $payment_main = [];
        // foreach($payment_id as $key => $tranid){
        //     $payment[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        //     $payment_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        // }
        return view('reports.report_by_groupe.report_by_groupe', compact('receive','receive_main'));
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
        $receive_id = Transaction_Detail::whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->orderBy('tran_date','asc')
        ->distinct('tran_id')
        ->pluck('tran_id');
        
        // //get unique transaction id where tran_type payment
        // $payment_id = Transaction_Detail::where('tran_type', 'payment')
        // ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        // ->orderBy('tran_date','asc')
        // ->distinct('tran_id')
        // ->pluck('tran_id');

        
        $receive = [];
        $receive_main = [];
        foreach($receive_id as $key => $tranid){
            $receive[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
            $receive_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        }
        
        // $payment = [];
        // $payment_main = [];
        // foreach($payment_id as $key => $tranid){
        //     $payment[$key] = Transaction_Detail::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        //     $payment_main[$key] = Transaction_Main::where('tran_id', $tranid)->orderBy('tran_date','asc')->paginate(15);
        // }

        
        if(count($receive) > 0 ){
            return response()->json([
                'status' => 'success',
                'data' => view('reports.report_by_groupe.search', compact('receive','receive_main'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    } //End Method



    // // Show Summary Report  
    // public function SummaryReport(){
        // $groupes = Transaction_Groupe::orderBy('tran_groupe_name')->get();
        // $head_groupe = [];
        // foreach ($groupes as $key => $groupe) {
        //     $head_groupe[$key] = Transaction_Head::where('groupe_id',$groupe->id)->orderBy('tran_head_name')->get();
        // }

    //     // foreach ($head_groupe as $key => $heads) {
    //     //     foreach ($heads as $key => $head) {
    //     //         $head_groupe[$key] = Transaction_Head::where('groupe_id',$groupe->id)->orderBy('tran_head_name')->get();
    //     //     }
            
    //     // }

    //     // dd("groupe",$groupe, 'head', $heads);
    //     return view('reports.summary_report.summary_report', compact('groupes','head_groupe'));
    // } //End Method


    ///////////////////////// --------------------------- Summary Report Part Start -------------------- /////////////////////////
    //Show Summary Report
    public function SummaryReport(){
        $groupes = Transaction_Groupe::orderBy('tran_groupe_name')->get();
        $head_groupe = [];
        foreach ($groupes as $key => $groupe) {
            $head_groupe[$key] = Transaction_Head::where('groupe_id',$groupe->id)->orderBy('tran_head_name')->get();
        }
    
        $transactions = collect(); // Initialize an empty collection to store transactions
    
        foreach ($head_groupe as $heads) {
            foreach ($heads as $head) {
                $transaction = Transaction_Detail::select(
                    'tran_type',
                    'tran_groupe_id',
                    'tran_head_id',
                    DB::raw('SUM(quantity) as total_quantity'),
                    // DB::raw('SUM(amount) as total_amount'),
                    DB::raw('SUM(tot_amount) as total_tot_amount'),
                )
                ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
                ->where('tran_head_id', $head->id)
                ->groupBy('tran_type','tran_groupe_id','tran_head_id')
                ->orderBy('tran_id','asc')
                ->get();
                
                $transactions = $transactions->merge($transaction); // Merge the current transactions with the collection
            }
        }

    
        return view('reports.summary_report.summary_report', compact('transactions'));
    } //End Method


    //Show Summary Report
    public function SearchSummaryReport(Request $req){
        $groupes = Transaction_Groupe::orderBy('tran_groupe_name')->get();
        $head_groupe = [];
        foreach ($groupes as $key => $groupe) {
            $head_groupe[$key] = Transaction_Head::where('groupe_id',$groupe->id)->orderBy('tran_head_name')->get();
        }
    
        $transactions = collect(); // Initialize an empty collection to store transactions
    
        foreach ($head_groupe as $heads) {
            foreach ($heads as $head) {
                $transaction = Transaction_Detail::select(
                    'tran_type',
                    'tran_groupe_id',
                    'tran_head_id',
                    DB::raw('SUM(quantity) as total_quantity'),
                    // DB::raw('SUM(amount) as total_amount'),
                    DB::raw('SUM(tot_amount) as total_tot_amount'),
                )
                ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
                ->where('tran_head_id', $head->id)
                ->groupBy('tran_type','tran_groupe_id','tran_head_id')
                ->orderBy('tran_id','asc')
                ->get();
                
                $transactions = $transactions->merge($transaction); // Merge the current transactions with the collection
            }
        }


        if($transactions->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('reports.summary_report.search', compact('transactions'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status' => 'null',
            ]);
        }

        // dd($transactions);
        return ;
    } //End Method






    ///////////////////////// --------------------------- Summary Report Part End -------------------- /////////////////////////


    ///////////////////////// --------------------------- Party Summary Report Part Start -------------------- /////////////////////////

    // Show Party Summary Report  
    public function PartySummaryReport(){
        $transactions = Transaction_Main::select(
            'tran_type',
            'tran_type_with',
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(receive) as total_receive'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due) as total_due'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due_col) as total_due_col')
        )
        ->whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->groupBy('tran_type', 'tran_type_with', 'tran_user')
        ->orderBy('tran_id','asc')
        ->paginate(15);
        

        return view('reports.summary_report.party_summary.party_summary_report', compact('transactions'));
    } //End Method



    // Search Party Summary Report
    public function SearchPartySummaryReport(Request $req){
        $transactions = Transaction_Main::with($req->searchOption == 1 ? 'User' : 'Withs')
        ->whereHas($req->searchOption == 1 ? 'User' : 'Withs', function ($query) use ($req) {
            $query->where($req->searchOption == 1 ? 'user_name' : 'tran_with_name', 'like', '%'.$req->search.'%');
        })
        ->select(
            'tran_type',
            'tran_type_with',
            'tran_user',
            DB::raw('SUM(bill_amount) as total_bill_amount'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(net_amount) as total_net_amount'),
            DB::raw('SUM(receive) as total_receive'),
            DB::raw('SUM(payment) as total_payment'),
            DB::raw('SUM(due) as total_due'),
            DB::raw('SUM(due_disc) as total_due_disc'),
            DB::raw('SUM(due_col) as total_due_col')
        )
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->when($req->type !== null, function ($query) use ($req) {
            return $query->where('tran_type', $req->type);
        })
        ->groupBy('tran_type', 'tran_type_with', 'tran_user')
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $transactions->links()->toHtml();

        if($transactions->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('reports.summary_report.party_summary.search', compact('transactions'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status' => 'null',
            ]);
        }
    } //End Method


    ///////////////////////// --------------------------- Party Summary Report Part End -------------------- /////////////////////////


    ///////////////////////// --------------------------- Party Details Report Part Start -------------------- /////////////////////////
    // Show Party Details Report  
    public function PartyDetailsReport(){
        $transactions = Transaction_Main::whereRaw("DATE(tran_date) = ?", [date('Y-m-d')])
        ->orderBy('tran_id','asc')
        ->paginate(15);
        return view('reports.details_report.party_details.party_details_report', compact('transactions'));
    } //End Method


    // Search Party Details Report
    public function SearchPartyDetailsReport(Request $req){
        $transactions = Transaction_Main::with($req->searchOption == 1 ? 'User' : 'Withs')
        ->whereHas($req->searchOption == 1 ? 'User' : 'Withs', function ($query) use ($req) {
            $query->where($req->searchOption == 1 ? 'user_name' : 'tran_with_name', 'like', '%'.$req->search.'%');
        })
        ->whereRaw("DATE(tran_date) BETWEEN ? AND ?", [$req->startDate, $req->endDate])
        ->when($req->type !== null, function ($query) use ($req) {
            return $query->where('tran_type', $req->type);
        })
        ->orderBy('tran_date','asc')
        ->paginate(15);
        
        $paginationHtml = $transactions->links()->toHtml();

        if($transactions->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('reports.details_report.party_details.search', compact('transactions'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status' => 'null',
            ]);
        }
    } //End Method


    ///////////////////////// --------------------------- Party Details Report Part End -------------------- /////////////////////////
}
