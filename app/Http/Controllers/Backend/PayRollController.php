<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendence; 
use App\Models\User_Info; 
use App\Models\Transaction_With; 
use App\Models\Transaction_Head; 
use App\Models\Transaction_Main; 
use App\Models\Transaction_Detail; 
use App\Models\Pay_Roll_Setup; 
use App\Models\Pay_Roll_Setup_Additional; 
use Carbon\Carbon;

class PayRollController extends Controller
{
    //Attendance All Method
    public function EmployeeAttendenceList(){

        $allData = Attendence::select('date')->groupBy('date')->orderBy('id','desc')->get();
        return view('attendance.view_employee_attend',compact('allData'));

    } // End Method 

    public function AddEmployeeAttendence(){
        $employees = User_Info::where('user_type', 'employee')->get();
        return view('attendance.add_employee_attend',compact('employees'));
    }// End Method 

    public function EmployeeAttendenceStore(Request $request){

        Attendence::where('date',date('Y-m-d',strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee ; $i++) { 
           $attend_status = 'attend_status'.$i;
           $attend = new Attendence();
           $attend->date = date('Y-m-d',strtotime($request->date));
           $attend->employee_id = $request->employee_id[$i];
           $attend->attend_status  = $request->$attend_status;
           $attend->save();
        }

         $notification = array(
            'message' => 'Data Inseted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attend.list')->with($notification); 
    }// End Method 


    public function EditEmployeeAttendence($date){
        $employees = User_Info::where('user_type', 'employee')->get();
        $editData = Attendence::where('date',$date)->get();
        return view('attendance.edit_employee_attend',compact('employees','editData'));

    }// End Method 


    public function ViewEmployeeAttendence($date){
        $details = Attendence::where('date',$date)->get();
        return view('attendance.details_employee_attend',compact('details'));
    }// End Method 



    /////////////// ----------------------- Payroll Setup Part Start Here ------------------- ////////////////
    // Show Payroll Setup
    public function ShowPayrollSetup(){
        $payroll = Pay_Roll_Setup::orderBy('id','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','employee')->get();
        $heads = Transaction_Head::where('groupe_id','1')->get();
        return view('payroll.payroll_setup.payrollSetup',compact('payroll','tranwith','heads'));
    } // End Method 



    // Get Payroll By User
    public function GetPayrollByUserId(Request $req){
        $currentYear = Carbon::now()->year; // Get the current date in 'Y-m-d' format
        $currentMonth = Carbon::now()->month;
        $payrolls = Pay_Roll_Setup::with('Head')
        ->where('emp_id', $req->id)
        ->where(function ($query) use ($currentYear, $currentMonth) {
            $query->whereYear('date', $currentYear)
                ->whereMonth('date', $currentMonth)
                ->orWhereNull('date');
        })
        ->get();
        return response()->json([
            'status'=> 'success',
            'data'=> view('payroll.payroll_installment.details',compact('payrolls'))->render(),
        ]); 
    } // End Method 



    // Add Payroll Setup
    public function AddPayrollSetup(Request $req){
        $req->validate([
            "with" => 'required',
            "user" => 'required',
            "head" => 'required',
            "amount" => 'required',
        ]);

        
        Pay_Roll_Setup::insert([
            "emp_id" => $req->user,
            "head_id" => $req->head,
            "amount" => $req->amount,
            "date" => $req->date,
        ]);

        return response()->json([
            'status'=>'success',
        ]); 
    }



    // Edit Payroll Setup
    public function EditPayrollSetup(Request $req){
        $payroll = Pay_Roll_Setup::with('Employee')->where('id',$req->id)->findOrFail($req->id);
        $tranwith = Transaction_With::where('user_type','employee')->get();
        $heads = Transaction_Head::where('groupe_id','11')->get();
        return response()->json([
            'payroll'=>$payroll,
            'tranwith'=>$tranwith,
            'heads'=>$heads,
        ]);
    } // End Method 



    // Update Payroll Setup
    public function UpdatePayrollSetup(Request $req){
        $req->validate([
            "with" => 'required',
            "user" => 'required',
            "head" => 'required',
            "amount" => 'required',
        ]);


        $update = Pay_Roll_Setup::findOrFail($req->id)->update([
            "emp_id" => $req->user,
            "head_id" => $req->head,
            "amount" => $req->amount,
            "date" => $req->date,
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Payroll Setup
    public function DeletePayrollSetup(Request $req){
        Pay_Roll_Setup::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    // Additional Payroll Setup Pagination
    public function PayrollSetupPagination(){
        $payroll = Pay_Roll_Setup::orderBy('id','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('payroll.payroll_setup.payrollSetupPagination',compact('payroll'))->render(),
        ]);
    } // End Method



    // Search Payroll Setup by user
    public function SearchPayrollSetup(Request $req){
        $payroll = Pay_Roll_Setup::with($req->searchOption == 1 ? 'Employee' : 'Head')
        ->whereHas($req->searchOption == 1 ? 'Employee' : 'Head', function ($query) use ($req) {
            $query->where($req->searchOption == 1 ? 'user_name' : 'tran_head_name', 'like', '%'.$req->search.'%');
            $query->orderby($req->searchOption == 1 ? 'user_name' : 'tran_head_name');
        })
        ->paginate(15);

        $paginationHtml = $payroll->links()->toHtml();

        if($payroll->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('payroll.payroll_setup.search', compact('payroll'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status' => 'null',
            ]);
        }
    }

    /////////////// ----------------------- Payroll Setup Part End Here ------------------- ////////////////


    ////////////// ------------------------ Payroll Part Start Here --------------------- ////////////////////////////
    // Show Payroll
    public function ShowPayroll(){
        $payroll = Transaction_Main::where('tran_type','payment')->whereIn('tran_type_with',['1','2','3'])->orderBy('id','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','employee')->get();
        return view('payroll.payroll_installment.payroll',compact('payroll','tranwith'));
    } // End Method 


    // Add Payroll
    public function AddPayroll(Request $req){
        $req->validate([
            "with" => 'required',
            "user" => 'required',
        ]);


        if($req->user != null){
            $currentYear = Carbon::now()->year; // Get the current date in 'Y-m-d' format
            $currentMonth = Carbon::now()->month;
            
            $payrolls = Pay_Roll_Setup::with('Head')
            ->where('emp_id', $req->user)
            ->where(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('date', $currentYear)
                    ->whereMonth('date', $currentMonth)
                    ->orWhereNull('date');
            })
            ->get();
            

            $transaction = Transaction_Main::where('tran_type', 'payment')->latest('tran_id')->first();
            $id = ($transaction) ? 'P' . str_pad((intval(substr($transaction->tran_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'P000000001';
            
            if($payrolls != null){
                $salary = 0;
                foreach ($payrolls as $key => $payroll) {
                    $salary += $payroll->amount; 
                    
                    Transaction_Detail::insert([
                        'tran_id'=>$id,
                        'tran_type'=> 'payment',
                        'tran_type_with'=> $req->with,
                        'tran_user'=> $req->user,
                        'tran_groupe_id'=> '1',
                        'tran_head_id'=> $payroll->head_id,
                        'quantity'=> '1',
                        'amount'=> $payroll->amount,
                        'tot_amount'=> $payroll->amount,
                    ]);
                }

                Transaction_Main::insert([
                    'tran_id'=>$id,
                    'tran_type'=> 'payment',
                    'tran_type_with'=> $req->with,
                    'tran_user'=> $req->user,
                    'bill_amount'=> $salary,
                    'discount'=> 0,
                    'net_amount'=> $salary,
                    'payment'=> $salary,
                    'due'=> 0,
                ]);

                return response()->json([
                    'status'=>'success',
                ]);
            }
             
        }
        
    }



    // Edit Payroll
    public function EditPayroll(Request $req){
        $payroll = Pay_Roll_Setup::with('Employee')->where('id',$req->id)->findOrFail($req->id);
        $tranwith = Transaction_With::where('user_type','employee')->get();
        $heads = Transaction_Head::where('groupe_id','1')->get();
        return response()->json([
            'payroll'=>$payroll,
            'tranwith'=>$tranwith,
            'heads'=>$heads,
        ]);
    } // End Method 



    // Update Payroll
    public function UpdatePayroll(Request $req){
        $req->validate([
            "with" => 'required',
            "user" => 'required',
            "head" => 'required',
            "amount" => 'required',
        ]);


        $update = Pay_Roll_Setup::findOrFail($req->id)->update([
            "emp_id" => $req->user,
            "head_id" => $req->head,
            "amount" => $req->amount,
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Payroll
    public function DeletePayroll(Request $req){
        Pay_Roll_Setup::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    // Payroll Pagination
    public function PayrollPagination(){
        $payroll = Pay_Roll_Setup::orderBy('id','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('payroll.payroll_setup.payrollSetupPagination',compact('payroll'))->render(),
        ]);
    } // End Method


    // Search Payroll by user
    public function SearchPayroll(Request $req){
        $payroll = Pay_Roll_Setup::with($req->searchOption == 1 ? 'Employee' : 'Head')
        ->whereHas($req->searchOption == 1 ? 'Employee' : 'Head', function ($query) use ($req) {
            $query->where($req->searchOption == 1 ? 'user_name' : 'tran_head_name', 'like', '%'.$req->search.'%');
            $query->orderby($req->searchOption == 1 ? 'user_name' : 'tran_head_name');
        })
        ->paginate(15);

        $paginationHtml = $payroll->links()->toHtml();

        if($payroll->count() > 0){
            return response()->json([
                'status' => 'success',
                'data' => view('payroll.payroll_setup.search', compact('payroll'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status' => 'null',
            ]);
        }
    }

    ////////////// ------------------------ Payroll Part End Here --------------------- ////////////////////////////
}
