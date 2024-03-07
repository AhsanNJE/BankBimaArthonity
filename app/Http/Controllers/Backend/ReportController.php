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








}
