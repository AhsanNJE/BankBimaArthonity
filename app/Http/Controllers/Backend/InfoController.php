<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User_Info;
use App\Models\PersonalDetail;
use App\Models\EducationDetail;
use App\Models\TrainingDetail;
use App\Models\ExperienceDetail;
use App\Models\OrganizationDetail;
use App\Models\Transaction_With;


class InfoController extends Controller
{


    ////////////////////////////////////       Employee Personal Detail         //////////////////////////////////////




    //Personal Detail View Show
    public function ShowEmployeesPersonal(){

        return view('hr.personaldetail.addPersonalDetail.');

    } // End Method 

    public function InsertPersonalDetails(Request $request){

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
            'nid_no' => 'required|numeric',
            'phn_no' =>  'required|numeric|unique:user__infos,user_phone,phone',
            'blood_group' => 'required',
            'email' => 'required|email|unique:user__infos,user_email,email',
            'location'  => 'required',
            'type'=> 'required',
            'address' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
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
            "nid_no" => $request->nid_no,
            "phn_no" =>  $request->phn_no,
            "blood_group" => $request->blood_group,
            "email" => $request->email,
            "location_id" => $request->location,
            "tran_user_type" => $request->type,
            "address" => $request->address,
            "image" => $imageName,
        ]);
 
        //Insert Info to User__Info 
        User_Info::insert([
            "user_id" => $id,
            "user_name" => $request->name,
            "user_email" => $request->email,
            "user_phone" => $request->phn_no,
            "gender" => $request->gender,
            "loc_id" => $request->location,
            "user_type" => 'employee',
            "tran_user_type" => $request->type,
            "dob" => $request->date_of_birth,
            "nid" => $request->nid_no,
            "address" => $request->address,
            "image" => $imageName,
        ]); 
        
        return response()->json([
            'status'=>'success',
        ]);  
    }

    public function ShowEmployeesPersonalInfo(Request $request){
        $employeepersonal = PersonalDetail::paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.personaldetail.employeePersonalDetails', compact('employeepersonal','tranwith'));

    }

    public function EmployeesPersonalInfo(Request $request){
        $employeepersonal = PersonalDetail::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.personaldetail.employeePersonalInfo', compact('employeepersonal'))->render(),
        ]);
    }





    ////////////////////////////////////       Employee Education Detail         //////////////////////////////////////





    //Education Detail View Show
    public function ShowEmployeesEducation(){

        return view('hr.educationdetail.addEducationDetail');

    } // End Method 

    public function InsertEducationDetails(Request $request){

        //Validate Employee Education Details
        $request->validate([
            'user' => 'required',
            'level_of_education' => 'required|string|max:255',
            'degree_title' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'institution_name' => 'required|string|max:255',
            'result' => 'required|string|max:255',
            'scale' => 'required|numeric',
            'cgpa' => 'required|numeric',
            'batch' => 'required|numeric',
            'passing_year' => 'required|numeric',
        ]);
    
        // Create a new Education instance and save the data
        $education = new EducationDetail();
        $education->emp_id =  $request->input('user');
        $education->level_of_education = $request->input('level_of_education');
        $education->degree_title = $request->input('degree_title');
        $education->group = $request->input('group');
        $education->institution_name = $request->input('institution_name');
        $education->result = $request->input('result');
        $education->scale = $request->input('scale');
        $education->cgpa = $request->input('cgpa');
        $education->batch = $request->input('batch');
        $education->passing_year = $request->input('passing_year');
        $education->save();
    
        return response()->json([
            'status'=>'success',
        ]); 
}

    public function ShowEmployeesEducationInfo(Request $request){
        $employeeeducation = EducationDetail::paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.educationdetail.employeeEducationDetails', compact('employeeeducation','tranwith'));
        
    }

    public function EmployeesEducationInfo(Request $request){
        $employeeeducation = EducationDetail::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.educationdetail.employeeEducationInfo', compact('employeeeducation'))->render(),
        ]);
    }





    ////////////////////////////////////       Employee Training Detail         //////////////////////////////////////




    


    //Training Detail View Show
    public function ShowEmployeesTraining(){

        return view('hr.trainingdetail.addTrainingDetail');

    } // End Method 

    public function InsertTrainingDetails(Request $request){

        //Validate Employee Training Details
        $request->validate([
            'user' => 'required',
            'training_title' => 'required',
            'country' => 'required',
            'topic' => 'required',
            'institution_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'training_year' => 'required|numeric',
        ]);

        // Create a new Training instance and save the data
        $training = new TrainingDetail();
        $training->emp_id =  $request->input('user');
        $training->training_title = $request->input('training_title');
        $training->country = $request->input('country');
        $training->topic = $request->input('topic');
        $training->institution_name = $request->input('institution_name');
        $training->start_date = $request->input('start_date');
        $training->end_date = $request->input('end_date');
        $training->training_year = $request->input('training_year');
        $training->save();
    
        return response()->json([
            'status'=>'success',
        ]); 

    }

    public function ShowEmployeesTrainingInfo(Request $request){
        $employeetraining = TrainingDetail::paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.trainingdetail.employeeTrainingDetails', compact('employeetraining','tranwith'));
        
    }

    public function EmployeesTrainingInfo(Request $request){
        $employeetraining = TrainingDetail::where('id', "=", $request->id)->get();
        return response()->json([
            'data'=>view('hr.trainingdetail.employeeTrainingInfo', compact('employeetraining'))->render(),
        ]);
    }





    ////////////////////////////////////       Employee Experience Detail         //////////////////////////////////////




    





    //Experience Detail View Show
    public function ShowEmployeesExperience(){

        return view('hr.experiencedetail.addExperienceDetail');

    } // End Method 

    public function InsertExperienceDetails(Request $request){

        //Validate Employee Experience Details
        $request->validate([
            'user' => 'required',
            'company_name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            
        ]);

        ExperienceDetail::insert([
            'emp_id' =>  $request->user,
            "company_name" => $request->company_name,
            "designation" =>  $request->designation,
            "department" => $request->department,
            "company_location" => $request->location,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
        ]);


        return response()->json([
            'status'=>'success',
        ]); 

    }

    public function ShowEmployeesExperienceInfo(Request $request){
        $employeeexperience = ExperienceDetail::paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.experiencedetail.employeeExperienceDetails', compact('employeeexperience','tranwith'));
        
    }

    public function EmployeesExperienceInfo(Request $request){
        $employeeexperience = ExperienceDetail::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.experiencedetail.employeeExperienceInfo', compact('employeeexperience'))->render(),
        ]);
    }





    ////////////////////////////////////       Employee Organization Detail         //////////////////////////////////////




    







    //Organization Detail View Show
    public function ShowEmployeesOrganization(){

        return view('hr.organizationdetail.addOrganizationDetail');

    } // End Method 

    
    public function InsertOrganizationDetails(Request $request){

        //Validate Employee Organization Details
        $request->validate([
            'user' => 'required',
            'joining_date' => 'required',
            'location' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);

        //Insert Employee Joining Details
        OrganizationDetail::insert([
            'emp_id' =>  $request->user,
            "joining_date" => $request->joining_date,
            "joining_location" =>  $request->location,
            "department" => $request->department,
            "designation" => $request->designation,
        ]);

        return response()->json([
            'status'=>'success',
        ]); 

    }
    

    public function ShowEmployeesOrganizationInfo(Request $request){
        $employeeorganization = OrganizationDetail::paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.organizationdetail.employeeOrganizationDetails', compact('employeeorganization','tranwith'));
        
    }

    public function EmployeesOrganizationInfo(Request $request){
        $employeeorganization = OrganizationDetail::where('id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.organizationdetail.employeeOrganizationInfo', compact('employeeorganization'))->render(),
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

        //Insert Employee Organization Details
        $update = OrganizationDetail::findOrFail($request->id)->update([
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