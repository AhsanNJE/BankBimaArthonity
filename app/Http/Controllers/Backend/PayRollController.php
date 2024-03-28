<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendence; 
use App\Models\User_Info; 
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


}