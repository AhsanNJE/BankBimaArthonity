<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Storage;
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


    ////////////////////////////////////       Employee Personal Detail         ////////////////////////////////////




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
        $employee = User_Info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.personaldetail.employeePersonalDetails', compact('employee','tranwith'));

    }

    public function EmployeesPersonalInfo(Request $request){
        $employeepersonal = PersonalDetail::where('employee_id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.personaldetail.employeePersonalInfo', compact('employeepersonal'))->render(),
        ]);
    }


    //Edit Employees Personal
    public function EditEmployeePersonal(Request $request){
        $employee = PersonalDetail::with('Location')->where('employee_id', $request->id)->first();
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method



    //Update Employees Personal
    public function UpdateEmployeePersonal(Request $request){
        
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
            'phn_no' =>  'required|numeric',
            'blood_group' => 'required',
            'email' => 'required|email',
            'location'  => 'required',
            'type'=> 'required',
            'address' => 'required',
        ]);

        $employee = PersonalDetail::where('employee_id', $request->employee_id)->first();
        $path = 'public/profiles/'.$employee->image;
        
        if($request->image != null){
            $request->validate([
                "image" => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            //process the image name and store it to storage/app/public/profiles directory
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::delete($path);
                $imageName = $request->employee_id. '('. $request->name . ').' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('public/profiles', $imageName);
            }
        }
        else{
            $imageName = $employee->image;
        }

        $update1 = PersonalDetail::findOrFail($request->id)->update([
     
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
            "updated_at" => now()
        ]);
       
        $update2 = User_Info::where('user_id', $request->employee_id)->update([
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
            "updated_at" => now()
        ]);
        if($update1 && $update2){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method

    //Delete Employee Personal
    public function DeleteEmployeePersonal(Request $request){
        PersonalDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    /////////////////////////               Employee Personal Search               ////////////////////////////////

    //Employee Pagination
    public function EmployeePersonalPagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('hr.personaldetail.employeePersonalDetailPage', compact('employee'))->render(),
        ]);
    }//End Method

    // Search Employee by Name
    public function SearchEmployeesPersonal(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Email
    public function SearchEmployeePersonalByEmail(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Phone
    public function SearchEmployeePersonalByPhone(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Location
    public function SearchEmployeePersonalByLocation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Address
    public function SearchEmployeePersonalByAddress(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by NID
    public function SearchEmployeePersonalByNid(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('nid', 'like', '%'.$request->search.'%')
            ->orderBy('nid','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Date Of Birth
    public function SearchEmployeePersonalByDob(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('dob', 'like', '%'.$request->search.'%')
            ->orderBy('dob','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.personaldetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    
     




    ////////////////////////////////////       Employee Education Detail         //////////////////////////////////////





    public function InsertEducationDetails(Request $request){

        //Validate Employee Education Details
        $request->validate([
            'user' => 'required',
            'level_of_education' => 'required|string|max:255',
            'degree_title' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'institution_name' => 'required|string|max:255',
            'result' => 'nullable|string|max:255',
            'scale' => 'nullable|numeric',
            'cgpa' => 'required|numeric',
            'batch' => 'nullable|numeric',
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
        $employee = User_Info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.educationdetail.employeeEducationDetails', compact('employee','tranwith'));
        
    }

    public function EmployeesEducationInfo(Request $request){
        $employeeeducation = EducationDetail::with('personalDetail')->where('emp_id', $request->id)->get();
        $personaldetail = PersonalDetail::where('employee_id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.educationdetail.employeeEducationInfo', compact('employeeeducation', 'personaldetail'))->render(),
        ]);
    }

    public function EmployeesEducation(Request $request){
        $employeeeducation = EducationDetail::with('personalDetail')->where('emp_id', $request->id)->paginate(15);
        return response()->json([
            'data'=>view('hr.educationdetail.detailseducation', compact('employeeeducation'))->render(),
        ]);
    }


    //Edit Employees Education
    public function EditEmployeeEducation(Request $request){
        $employee = EducationDetail::where('id', $request->id)->first();
        //dd($employee);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method

    //Update Employees Education
    public function UpdateEmployeeEducation(Request $request){
        
        $request->validate([
            'level_of_education' => 'required|string|max:255',
            'degree_title' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'institution_name' => 'required|string|max:255',
            'result' => 'nullable|string|max:255',
            'scale' => 'nullable|numeric',
            'cgpa' => 'required|numeric',
            'batch' => 'nullable|numeric',
            'passing_year' => 'required|numeric',
        ]);

        $employee = EducationDetail::findOrFail($request->id);
        

        $update = EducationDetail::findOrFail($request->id)->update([
     
            'level_of_education' => $request->level_of_education,
            'degree_title' => $request->degree_title,
            'group' => $request->group,
            'institution_name' => $request->institution_name,
            'result' => $request->result,
            'scale' => $request->scale,
            'cgpa' => $request->cgpa,
            'batch' => $request->batch,
            'passing_year' => $request->passing_year,
            'updated_at' => now()
        ]);
       
        
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method


    //Delete Employee Education
    public function DeleteEmployeeEducation(Request $request){
        EducationDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method




    /////////////////////////                   Employee Education Search                   ////////////////////////////////


    //Employee Pagination
    public function EmployeeEducationPagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('hr.educationdetail.employeeEducationDetailPage', compact('employee'))->render(),
        ]);
    }//End Method

    // Search Employee by Name
    public function SearchEmployeesEducation(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Email
    public function SearchEmployeeEducationByEmail(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Phone
    public function SearchEmployeeEducationByPhone(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Location
    public function SearchEmployeeEducationByLocation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Address
    public function SearchEmployeeEducationByAddress(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by NID
    public function SearchEmployeeEducationByNid(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('nid', 'like', '%'.$request->search.'%')
            ->orderBy('nid','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Date Of Birth
    public function SearchEmployeeEducationByDob(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('dob', 'like', '%'.$request->search.'%')
            ->orderBy('dob','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.educationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    





    ////////////////////////////////////       Employee Training Detail         //////////////////////////////////////




     

    public function InsertTrainingDetails(Request $request){

        //Validate Employee Training Details
        $request->validate([
            'user' => 'required',
            'training_title' => 'required',
            'country' => 'nullable',
            'topic' => 'required',
            'institution_name' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
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
        $employee = User_Info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.trainingdetail.employeeTrainingDetails', compact('employee','tranwith'));
        
    }

    public function EmployeesTrainingInfo(Request $request){
        $employeetraining = TrainingDetail::with('personalDetail')->where('emp_id', "=", $request->id)->get();
        $personaldetail = PersonalDetail::where('employee_id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.trainingdetail.employeeTrainingInfo', compact('employeetraining', 'personaldetail'))->render(),
        ]);
    }

    public function EmployeesTraining(Request $request){
        $employeetraining = TrainingDetail::with('personalDetail')->where('emp_id', $request->id)->paginate(15);
        return response()->json([
            'data'=>view('hr.trainingdetail.detailstraining', compact('employeetraining'))->render(),
        ]);
    }

    //Edit Employees Training
    public function EditEmployeeTraining(Request $request){
        $employee = TrainingDetail::where('id', $request->id)->first();
        //dd($employee);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method

    //Update Employees Personal
    public function UpdateEmployeeTraining(Request $request){
        
        $request->validate([
            'training_title' => 'required',
            'country' => 'nullable',
            'topic' => 'required',
            'institution_name' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'training_year' => 'required|numeric',
        ]);

        $employee = TrainingDetail::findOrFail($request->id);
        

        $update = TrainingDetail::findOrFail($request->id)->update([
     
            'training_title' => $request->training_title,
            'country' => $request->country,
            'topic' => $request->topic,
            'institution_name' => $request->institution_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'training_year' => $request->training_year,
            'updated_at' => now()
        ]);
       
        
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method

    //Delete Employee Training
    public function DeleteEmployeeTraining(Request $request){
        TrainingDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    

    


    /////////////////////////                          Employee Training Search                           ////////////////////////////////


    //Employee Pagination
    public function EmployeeTrainingPagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('hr.trainingdetail.employeeTrainingDetailPage', compact('employee'))->render(),
        ]);
    }//End Method

    // Search Employee by Name
    public function SearchEmployeesTraining(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Email
    public function SearchEmployeeTrainingByEmail(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Phone
    public function SearchEmployeeTrainingByPhone(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Location
    public function SearchEmployeeTrainingByLocation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Address
    public function SearchEmployeeTrainingByAddress(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    // Search Employee by NID
    public function SearchEmployeeTrainingByNid(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('nid', 'like', '%'.$request->search.'%')
            ->orderBy('nid','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method

    

    // Search Employee by Date Of Birth
    public function SearchEmployeeTrainingByDob(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('dob', 'like', '%'.$request->search.'%')
            ->orderBy('dob','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.trainingdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method







    ////////////////////////////////////       Employee Experience Detail         //////////////////////////////////////




    





    public function InsertExperienceDetails(Request $request){

        //Validate Employee Experience Details
        $request->validate([
            'user' => 'required',
            'company_name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'company_location' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            
        ]);

        ExperienceDetail::insert([
            'emp_id' =>  $request->user,
            "company_name" => $request->company_name,
            "designation" =>  $request->designation,
            "department" => $request->department,
            "company_location" => $request->company_location,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
        ]);


        return response()->json([
            'status'=>'success',
        ]); 

    }

    public function ShowEmployeesExperienceInfo(Request $request){
        $employee = User_Info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.experiencedetail.employeeExperienceDetails', compact('employee','tranwith'));
        
    }

    public function EmployeesExperienceInfo(Request $request){
        $employeeexperience = ExperienceDetail::with('personalDetail')->where('emp_id', $request->id)->get();
        $personaldetail = PersonalDetail::where('employee_id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.experiencedetail.employeeExperienceInfo', compact('employeeexperience', 'personaldetail'))->render(),
        ]);
    }

    public function EmployeesExperience(Request $request){
        $employeeexperience = ExperienceDetail::with('personalDetail')->where('emp_id', $request->id)->paginate(15);
        return response()->json([
            'data'=>view('hr.experiencedetail.detailsexperience', compact('employeeexperience'))->render(),
        ]);
    }

    //Edit Employees Experience
    public function EditEmployeeExperience(Request $request){
        $employee = ExperienceDetail::where('id', $request->id)->first();
        //dd($employee);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method

    //Update Employees Experience
    public function UpdateEmployeeExperience(Request $request){
        
        $request->validate([
            'company_name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'company_location' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
        ]);

        $employee = ExperienceDetail::findOrFail($request->id);
        

        $update = ExperienceDetail::findOrFail($request->id)->update([
            "company_name" => $request->company_name,
            "designation" =>  $request->designation,
            "department" => $request->department,
            "company_location" => $request->company_location,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            'updated_at' => now()
        ]);
       
        
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method

    //Delete Employee Experience
    public function DeleteEmployeeExperience(Request $request){
        ExperienceDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method


    /////////////////////////                      Employee Experience Search                    ////////////////////////////////


    //Employee Pagination
    public function EmployeeExperiencePagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('hr.experiencedetail.employeeExperienceDetailPage', compact('employee'))->render(),
        ]);
    }//End Method

    // Search Employee by Name
    public function SearchEmployeesExperience(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Email
    public function SearchEmployeeExperienceByEmail(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Phone
    public function SearchEmployeeExperienceByPhone(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Location
    public function SearchEmployeeExperienceByLocation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Address
    public function SearchEmployeeExperienceByAddress(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by NID
    public function SearchEmployeeExperienceByNid(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('nid', 'like', '%'.$request->search.'%')
            ->orderBy('nid','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    
    // Search Employee by Date Of Birth
    public function SearchEmployeeExperienceByDob(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('dob', 'like', '%'.$request->search.'%')
            ->orderBy('dob','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.experiencedetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method







    ////////////////////////////////////       Employee Organization Detail         //////////////////////////////////////








    
    public function InsertOrganizationDetails(Request $request){

        //Validate Employee Organization Details
        $request->validate([
            'user' => 'required',
            'joining_date' => 'required',
            'location' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);

        //Insert Employee Organization Details
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
        $employee = User_Info::with('organizationDetail')->where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('hr.organizationdetail.employeeOrganizationDetails', compact('employee','tranwith'));
    }


    public function EmployeesOrganizationInfo(Request $request){
        $employeeorganization = OrganizationDetail::with('personalDetail')->where('emp_id', $request->id)->paginate(15);
        $personaldetail = PersonalDetail::where('employee_id', $request->id)->get();
        return response()->json([
            'data'=>view('hr.organizationdetail.employeeOrganizationInfo', compact('employeeorganization', 'personaldetail'))->render(),
        ]);
    }

    public function EmployeesOrganization(Request $request){
        $employeeorganization = OrganizationDetail::with('personalDetail')->where('emp_id', $request->id)->paginate(15);
        return response()->json([
            'data'=>view('hr.organizationdetail.detailsorganization', compact('employeeorganization'))->render(),
        ]);
    }

    

    //Edit Employees Organization
    public function EditEmployeeOrganization(Request $request){
        $employee = OrganizationDetail::with('Department','Designation','Location')->where('id', $request->id)->first();
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method



    //Update Employees Organization
    public function UpdateEmployeeOrganization(Request $request){
        
        $request->validate([
            'joining_date' => 'required',
            'location' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);

        $employee = OrganizationDetail::where('emp_id', $request->emp_id)->first();
        

        $update = OrganizationDetail::findOrFail($request->id)->update([
            "joining_date" => $request->joining_date,
            "joining_location" =>  $request->location,
            "department" => $request->department,
            "designation" => $request->designation,
            'updated_at' => now()
        ]);
       
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method

    //Delete Employee Organization
    public function DeleteEmployeeOrganization(Request $request){
        OrganizationDetail::findOrFail($request->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method
       

    




    /////////////////////////                          Employee Organization Search                           ////////////////////////////////


    //Employee Pagination
    public function EmployeeOrganizationPagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('hr.organizationdetail.employeeOrganizationDetailPage', compact('employee'))->render(),
        ]);
    }//End Method

    // Search Employee by Name
    public function SearchEmployeesOrganization(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_name', 'like', '%'.$request->search.'%')
            ->orWhere('id', 'like','%'.$request->search.'%')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_name','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Email
    public function SearchEmployeeOrganizationByEmail(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_email', 'like', '%'.$request->search.'%')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_email','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
        
    }//End Method



    // Search Employee by Phone
    public function SearchEmployeeOrganizationByPhone(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('user_phone', 'like', '%'.$request->search.'%')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('user_phone','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Location
    public function SearchEmployeeOrganizationByLocation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->where('upazila', 'like', '%'.$request->search.'%');
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Location')
            ->whereHas('Location', function ($query) use ($request) {
                $query->orderBy('upazila','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Address
    public function SearchEmployeeOrganizationByAddress(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('address', 'like', '%'.$request->search.'%')
            ->orderBy('address','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('address','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by NID
    public function SearchEmployeeOrganizationByNid(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('nid', 'like', '%'.$request->search.'%')
            ->orderBy('nid','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Date Of Birth
    public function SearchEmployeeOrganizationByDob(Request $request){
        if($request->search != ""){
            $employee = User_Info::where('user_type', 'employee')
            ->where('dob', 'like', '%'.$request->search.'%')
            ->orderBy('dob','asc')
            ->paginate(15);
        }
        else{
            $employee = User_Info::where('user_type', 'employee')
            ->orderBy('dob','asc')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('hr.organizationdetail.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


     
}