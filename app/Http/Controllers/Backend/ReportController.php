<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction_Main;

class ReportController extends Controller
{
    public function PendingDue(){

        $alldue = Transaction_Main::where('due','>','0')->orderBy('id','DESC')->get();
        return view('reports.due_statement',compact('alldue'));

    }// End Method 

    Public function Filter(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $alldue = Transaction_Main::where('tran_date','>=',$start_date)
                                    ->where('tran_date','<=',$end_date)
                                    ->get();

        return view('reports.due_statement',compact('alldue'));
    }
}
