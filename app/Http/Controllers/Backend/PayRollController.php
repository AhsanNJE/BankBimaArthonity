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

        $allData = Attendence::orderBy('id','desc')->get();
        return view('attendance.view_employee_attend',compact('allData'));

    } // End Method 

    public function AddEmployeeAttendence(){
        $employees = User_Info::where('user_type', 'employee')->get();
        return view('attendance.add_employee_attend',compact('employees'));
    }// End Method 



}
