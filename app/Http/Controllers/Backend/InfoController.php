<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PersonalDetail;
use App\Models\EducationDetail;
use App\Models\TrainingDetail;
use App\Models\ExperienceDetail;
use App\Models\JoiningDetail;
//use App\Models\EmployeeInfo;


class InfoController extends Controller
{

    public function ShowNewEmployees(){

        return view('hr.employee');

    } // End Method 

    public function InsertEmployees(Request $request){

    //Validate Employee Personal Details
    $request->validate([
        'name' => 'required',
        'fathers_name' => 'required',
        'mothers_name' => 'required',
        'date_of_birth' => 'required',
        'gender' => 'required|in:male,female,others',
        'religion' => 'required',
        'marital_status' => 'required',
        'nationality' => 'required',
        'phn_no' =>  'required|numeric|unique:user__infos,user_phone,phone',
        'blood_group' => 'required',
        'email' => 'required|email|unique:user__infos,user_email,email',
        'address' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
    ]);
    
    //Validate Employee Education Details
    $request->validate([
        'level_of_education' => 'required',
        'degree_title' => 'required',
        'group' => 'required',
        'institution_name' => 'required',
        'result' => 'required',
        'scale' => 'required|numeric',
        'cgpa' => 'required|numeric',
        'batch' => 'required|numeric',
        'passing_year' => 'required|numeric',
    ]);
    
    //Validate Employee Training Details
    $request->validate([
        'training_title' => 'required',
        'country' => 'required',
        'topic' => 'required',
        'institution_name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'training_year' => 'required|numeric',
    ]);

    //Validate Employee Experience Details
    $request->validate([
        'company_name' => 'required',
        'designation' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'department' => 'required',
        'company_location' => 'required',
    ]);
    
    //Validate Employee Joining Details
    $request->validate([
        'joining_date' => 'required',
        'joining_location' => 'required',
        'department' => 'required',
        'designation' => 'required',
    ]); 

    $NewEmployee = PersonalDetail::orderBy('employee_id','desc')->first();
    $id = ($NewEmployee) ? 'E' . str_pad((intval(substr($NewEmployee->employee_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'E000000101';

    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $originalName = $request->file('image')->getClientOriginalName();
        $imageName = $id. '('. $request->name . ').' . $request->file('image')->getClientOriginalExtension();
        $imagePath = $request->file('image')->storeAs('public/profiles', $imageName);
    }
    else{
        $imageName = null;
    }
    

    //Insert Employee Personal Details
    PersonalDetail::insert([
        'employee_id' =>  $id,
        'name' => $request->name,
        "fathers_name" => $request->fathers_name,
        "mothers_name" => $request->mothers_name,
        "date_of_birth" => $request->date_of_birth,
        "gender" => $request->gender,
        "religion" => $request->religion,
        "marital_status" => $request->marital_status,
        "nationality" => $request->nationality,
        "phn_no" =>  $request->phn_no,
        "blood_group" => $request->blood_group,
        "email" => $request->email,
        "address" => $request->address,
        "image" => $request->image,
    ]);
    
    //Insert Employee Education Details
    EducationDetail::insert([
        'emp_id' =>  $id,
        "level_of_education" => $request->level_of_education,
        "degree_title" => $request->degree_title,
        "group" => $request->group,
        "institution_name" => $request->institution_name,
        "result" => $request->result,
        "scale" => $request->scale,
        "cgpa" => $request->cgpa,
        "batch" => $request->batch,
        "passing_year" =>  $request->passing_year,
    ]);

    //Insert Employee Training Details
    TrainingDetail::insert([
        'emp_id' =>  $id,
        "training_title" => $request->training_title,
        "country" =>  $request->country,
        "topic" => $request->topic,
        "institution_name" => $request->institution_name,
        "start_date" => $request->start_date,
        "end_date" => $request->end_date,
        "training_year" => $request->training_year,
    ]);

    //Insert Employee Experience Details
    ExperienceDetail::insert([
        'emp_id' =>  $id,
        "company_name" => $request->company_name,
        "designation" =>  $request->designation,
        "start_date" => $request->start_date,
        "end_date" => $request->end_date,
        "department" => $request->department,
        "company_location" => $request->company_location,
    ]);

    //Insert Employee Joining Details
    JoiningDetail::insert([
        'emp_id' =>  $id,
        "joining_date" => $request->joining_date,
        "joining_location" =>  $request->joining_location,
        "department" => $request->department,
        "designation" => $request->designation,
    ]);

    return redirect()->route('show.info');
    }

    public function ShowEmployeesInfo(Request $request){
        $employeeinfo = PersonalDetail::paginate(15);
        return view('hr.employeeDetails', compact('employeeinfo'));

    }

    public function EmployeesInfo(Request $request){
        $employeeinfo = PersonalDetail::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.employeeAllInfo', compact('employeeinfo'))->render(),
        ]);
    }

    //Edit Employees
    public function EmployeesEdit(Request $request){
        $employeeinfo = PersonalDetail::where('id', $request->id)->findOrFail($request->id);
        return response()->json([
            'employeeinfo'=>$employeeinfo,
        ]);
    }//End Method



    //Update Employees
    public function EmployeesUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required|in:male,female,others',
            'religion' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
            'phn_no' =>  'required|numeric|unique:user__infos,user_phone,phone',
            'blood_group' => 'required',
            'email' => 'required|email|unique:user__infos,user_email,email',
            'address' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        
        //Validate Employee Education Details
        $request->validate([
            'level_of_education' => 'required',
            'degree_title' => 'required',
            'group' => 'required',
            'institution_name' => 'required',
            'result' => 'required',
            'scale' => 'required|numeric',
            'cgpa' => 'required|numeric',
            'batch' => 'required|numeric',
            'passing_year' => 'required|numeric',
        ]);
        
        //Validate Employee Training Details
        $request->validate([
            'training_title' => 'required',
            'country' => 'required',
            'topic' => 'required',
            'institution_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'training_year' => 'required|numeric',
        ]);
    
        //Validate Employee Experience Details
        $request->validate([
            'company_name' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'department' => 'required',
            'company_location' => 'required',
        ]);
        
        //Validate Employee Joining Details
        $request->validate([
            'joining_date' => 'required',
            'joining_location' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);

        $employeeinfo = PersonalDetail::findOrFail($request->id);
        
        if($request->image != null){
            $request->validate([
                "image" => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            //process the image name and store it to storage/app/public/profiles directory
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $originalName = $request->file('image')->getClientOriginalName();
                $imageName = $request->employee_id. '('. $request->name . ').' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('public/profiles', $imageName);
            }
        }
        else{
            $imageName = $employeeinfo->image;
        }
        
        

        $update = PersonalDetail::findOrFail($request->id)->update([
        'employee_id' =>  $id,
        'name' => $request->name,
        "fathers_name" => $request->fathers_name,
        "mothers_name" => $request->mothers_name,
        "date_of_birth" => $request->date_of_birth,
        "gender" => $request->gender,
        "religion" => $request->religion,
        "marital_status" => $request->marital_status,
        "nationality" => $request->nationality,
        "phn_no" =>  $request->phn_no,
        "blood_group" => $request->blood_group,
        "email" => $request->email,
        "address" => $request->address,
        "image" => $request->image,
    ]);
    
        $update = EducationDetail::findOrFail($request->id)->update([
        'emp_id' =>  $id,
        "level_of_education" => $request->level_of_education,
        "degree_title" => $request->degree_title,
        "group" => $request->group,
        "institution_name" => $request->institution_name,
        "result" => $request->result,
        "scale" => $request->scale,
        "cgpa" => $request->cgpa,
        "batch" => $request->batch,
        "passing_year" =>  $request->passing_year,
    ]);

        $update = TrainingDetail::findOrFail($request->id)->update([
        'emp_id' =>  $id,
        "training_title" => $request->training_title,
        "country" =>  $request->country,
        "topic" => $request->topic,
        "institution_name" => $request->institution_name,
        "start_date" => $request->start_date,
        "end_date" => $request->end_date,
        "training_year" => $request->training_year,
    ]);

        //Insert Employee Experience Details
        $update = ExperienceDetail::findOrFail($request->id)->update([
        'emp_id' =>  $id,
        "company_name" => $request->company_name,
        "designation" =>  $request->designation,
        "start_date" => $request->start_date,
        "end_date" => $request->end_date,
        "department" => $request->department,
        "company_location" => $request->company_location,
    ]);

        //Insert Employee Joining Details
        $update = JoiningDetail::findOrFail($request->id)->update([
        'emp_id' =>  $id,
        "joining_date" => $request->joining_date,
        "joining_location" =>  $request->joining_location,
        "department" => $request->department,
        "designation" => $request->designation,
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Employees
    public function EmployeesDelete(Request $request){
        PersonalDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method
     
}