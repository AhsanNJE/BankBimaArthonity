<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Employee_Info;
use App\Models\Location_Info;
use App\Models\Department_Info;
use App\Models\User_Info;
use App\Models\Pay_Roll_Setup;
use App\Models\Transaction_With;


class EmployeeController extends Controller
{

    /////////////////////////// --------------- Departments Table Methods start ---------- //////////////////////////
    //Show All Departments
    public function ShowDepartments(){
        $department = Department_Info::orderBy('added_at','asc')->paginate(15);
        return view('employee.department.departments', compact('department'));
    }//End Method



    //Get Departments By Name
    public function GetDepartmentByName(Request $req){
        $departments = Department_Info::where('dept_name', 'like', '%'.$req->department.'%')
        ->orderBy('dept_name','asc')
        ->take(10)
        ->get();


        if($departments->count() > 0){
            $list = "";
            foreach($departments as $index => $department) {
                $list .= '<li tabindex="'.($index + 1).'" data-id="'.$department->id.'">'.$department->dept_name.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    }//End Method




    //Insert Departments
    public function InsertDepartments(Request $req){
        $req->validate([
            "deptName" => 'required|unique:department__infos,dept_name'
        ]);

        Department_Info::insert([
            "dept_name" => $req->deptName,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Department
    public function EditDepartments(Request $req){
        $department = Department_Info::findOrFail($req->id);
        return response()->json([
            'department'=>$department,
        ]);
    }//End Method



    //Update Departments
    public function UpdateDepartments(Request $req){
        $department = Department_Info::findOrFail($req->id);

        $req->validate([
            "deptName" => ['required',Rule::unique('department__infos', 'dept_name')->ignore($department->id)],
        ]);

        $update = Department_Info::findOrFail($req->id)->update([
            "dept_name" => $req->deptName,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Departments
    public function DeleteDepartments(Request $req){
        Department_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Department Pagination
    public function DepartmentPagination(){
        $department = Department_Info::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('employee.department.departmentPagination', compact('department'))->render(),
        ]);
    }//End Method



    //Departments Search
    public function SearchDepartments(Request $req){
        $department = Department_Info::where('dept_name', 'like', '%'.$req->search.'%')
        ->orderBy('dept_name','asc')
        ->paginate(15);

        $paginationHtml = $department->links()->toHtml();
        
        if($department->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.department.search', compact('department'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    /////////////////////////// --------------- Departments Table Methods start ---------- //////////////////////////




    /////////////////////////// --------------- Designations Table Methods start ---------- //////////////////////////
    
    //Show All Designations
    public function ShowDesignations(){
        $designations = Designation::orderBy('added_at','asc')->paginate(15);
        return view('employee.designation.designations', compact('designations'));
    }//End Method



    //Get Designation By Name And Department
    public function GetDesignationByNameAndDepartment(Request $req){
        if($req->department != ""){
            $designations = Designation::where('designation', 'like', '%'.$req->designation.'%')
            ->where('dept_id', $req->department)
            ->orderBy('designation','asc')
            ->take(10)
            ->get();

            if($designations->count() > 0){
                $list = "";
                foreach($designations as $index => $designation) {
                    $list .= '<li tabindex="'. ($index + 1) .'" data-id="'.$designation->id.'">'.$designation->designation.'</li>';
                }
            }
            else{
                $list = '<li>No Data Found</li>';
            }
            return $list;
        }
        else{
            return $list = "";
        }
    }//End Method


    //Insert Designations
    public function InsertDesignations(Request $req){
        $req->validate([
            "designations" => 'required|unique:designations,designation',
            "department" => 'required|numeric'
        ]);

        Designation::insert([
            "designation" => $req->designations,
            "dept_id" => $req->department,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Designations
    public function EditDesignations(Request $req){
        $designations = Designation::with('Department:id,dept_name')->findOrFail($req->id);
        return response()->json([
            'designations'=>$designations,
        ]);
    }//End Method



    //Update Designations
    public function UpdateDesignations(Request $req){
        $designations = Designation::findOrFail($req->id);

        $req->validate([
            "designations" => ['required',Rule::unique('designations', 'designation')->ignore($designations->id)],
            "department"  => 'required|numeric'
        ]);

        $update = Designation::findOrFail($req->id)->update([
            "designation" => $req->designations,
            "dept_id" => $req->department,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Designations
    public function DeleteDesignations(Request $req){
        Designation::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Designation Pagination
    public function DesignationPagination(){
        $designations = Designation::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('employee.designation.designationPagination', compact('designations'))->render(),
        ]);
    }//End Method



    //Designation Search
    public function SearchDesignations(Request $req){
        $designations = Designation::where('designation', 'like', '%'.$req->search.'%')
        ->orderBy('designation','asc')
        ->paginate(15);

        $paginationHtml = $designations->links()->toHtml();
        
        if($designations->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.designation.search', compact('designations'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //Designation Search
    public function SearchDesignationsByDepartment(Request $req){
        $designations = Designation::with('Department:id,dept_name')
        ->whereHas('Department', function ($query) use ($req) {
            $query->where('dept_name', 'like', '%' . $req->search . '%');
            $query->orderBy('dept_name','asc');
        })
        ->paginate(15);

        $paginationHtml = $designations->links()->toHtml();
        
        if($designations->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.designation.search', compact('designations'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Designations Table Methods start ---------- //////////////////////////




    /////////////////////////// --------------- Location Table Methods start ---------- //////////////////////////
    
    //Show All Locations
    public function ShowLocations(){
        $location = Location_Info::orderBy('added_at','asc')->paginate(15);
        return view('employee.location.locations', compact('location'));
    }//End Method



    //Get Location By Upazila
    public function GetLocationByUpazila(Request $req){
        $locations = Location_Info::where('upazila', 'like', '%'.$req->location.'%')
        ->orderBy('upazila','asc')
        ->take(10)
        ->get();


        if($locations->count() > 0){
            $list = "";
            foreach($locations as $index => $location) {
                $list .= '<li tabindex="' . ($index + 1) . '" data-id="'.$location->id.'">'.$location->upazila.'</li>';
            }
        }
        else{
            $list = '<li>No Data Found</li>';
        }
        return $list;
    }//End Method


    //Insert Locations
    public function InsertLocations(Request $req){
        $req->validate([
            "division" => 'required',
            "district" => 'required',
            "upazila" => 'required',
        ]);

        Location_Info::insert([
            "division" => $req->division,
            "district" => $req->district,
            "upazila" => $req->upazila,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Locations
    public function EditLocations(Request $req){
        $location = Location_Info::findOrFail($req->id);
        return response()->json([
            'location'=>$location,
        ]);
    }//End Method



    //Update Locations
    public function UpdateLocations(Request $req){
        $location = Location_Info::findOrFail($req->id);

        $req->validate([
            "division" => 'required',
            "district"  => 'required',
            "upazila"  => 'required',
        ]);

        $update = Location_Info::findOrFail($req->id)->update([
            "district" => $req->district,
            "division" => $req->division,
            "upazila" => $req->upazila,
            "updated_at" => now()
        ]);

        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Locations
    public function DeleteLocations(Request $req){
        Location_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Location Pagination
    public function LocationPagination(){
        $location = Location_Info::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('employee.location.locationPagination', compact('location'))->render(),
        ]);
    }//End Method



    //Search Location By Division
    public function SearchLocations(Request $req){
        $location = Location_Info::where('division', 'like', '%'.$req->search.'%')
        ->orderBy('division','asc')
        ->paginate(15);

        $paginationHtml = $location->links()->toHtml();
        
        if($location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.location.search', compact('location'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //Search Location By District
    public function SearchLocationByDistrict(Request $req){
        $location = Location_Info::where('district', 'like', '%'.$req->search.'%')
        ->orderBy('district','asc')
        ->paginate(15);

        $paginationHtml = $location->links()->toHtml();
        
        if($location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.location.search', compact('location'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    //Search Location By Upazila
    public function SearchLocationByUpazila(Request $req){
        $location = Location_Info::where('upazila', 'like', '%'.$req->search.'%')
        ->orderBy('upazila','asc')
        ->paginate(15);

        $paginationHtml = $location->links()->toHtml();
        
        if($location->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('employee.location.search', compact('location'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Location Table Methods start ---------- //////////////////////////
    



    /////////////////////////// --------------- Tran With Table Methods start ---------- //////////////////////////
    
    //Show All TranWith
    public function ShowTranWith(){
        $tranwith = Transaction_With::orderBy('added_at','asc')->paginate(15);
        return view('tran_with.tranWith', compact('tranwith'));
    }//End Method



    //Get Tran With By Type
    public function GetTranWithByType(Request $req){
        $tranwith = Transaction_With::where('user_type', $req->type)
        ->orderBy('user_type','asc')
        ->get();

        return response()->json([
            'status'=>'success',
            'tranwith'=>$tranwith,
        ]);  

    }//End Method



    //Insert Tran With
    public function InsertTranWith(Request $req){
        $req->validate([
            "name" => 'required|unique:transaction__withs,tran_with_name',
            "type" => 'required|in:Client,Employee,Supplier,Bank,Others'
        ]);

        Transaction_With::insert([
            "tran_with_name" => $req->name,
            "user_type" => $req->type,
        ]);

        return response()->json([
            'status'=>'success',
        ]);  
    }//End Method



    //Edit Tran With
    public function EditTranWith(Request $req){
        $tranwith = Transaction_With::findOrFail($req->id);
        return response()->json([
            'tranwith'=>$tranwith,
        ]);
    }//End Method



    //Update Tran With
    public function UpdateTranWith(Request $req){
        $tranwith = Transaction_With::findOrFail($req->id);

        $req->validate([
            "name" => ['required',Rule::unique('transaction__withs', 'tran_with_name')->ignore($tranwith->id)],
            "type"  => 'required'
        ]);

        $update = Transaction_With::findOrFail($req->id)->update([
            "tran_with_name" => $req->name,
            "user_type" => $req->type,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Tran With
    public function DeleteTranWith(Request $req){
        Transaction_With::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Tran With Pagination
    public function TranWithPagination(){
        $tranwith = Transaction_With::orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('tran_with.tranWithPagination', compact('tranwith'))->render(),
        ]);
    }//End Method



    //Designation Search
    public function SearchTranWith(Request $req){
        $tranwith = Transaction_With::where('tran_with_name', 'like', '%'.$req->search.'%')
        ->orderBy('tran_with_name','asc')
        ->paginate(15);

        $paginationHtml = $tranwith->links()->toHtml();
        
        if($tranwith->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('tran_with.search', compact('tranwith'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method




    //Designation Search
    public function SearchTranWithByType(Request $req){
        $tranwith = Transaction_With::where('user_type', 'like', '%' . $req->search . '%')
        ->orderBy('user_type','asc')
        ->paginate(15);

        $paginationHtml = $tranwith->links()->toHtml();
        
        if($tranwith->count() >= 1){
            return response()->json([
                'status' => 'success',
                'paginate' => $paginationHtml,
                'data' => view('tran_with.search', compact('tranwith'))->render(),
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Tran With Table Methods start ---------- //////////////////////////















    
    /////////////////////////// --------------- Employee Table Methods start ---------- //////////////////////////
    //Show All Employees
    public function ShowEmployees(){
        $employee = User_Info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return view('employee.employees', compact('employee','tranwith'));
    }//End Method


    //Show Employee Details
    public function ShowEmployeeDetails(Request $req){
        $employee = User_Info::with('Designation','Department','Location','Withs')->where('id', "=", $req->id)->first();
        $payroll = Pay_Roll_Setup::with('Head','Employee')->where('emp_id', $employee->user_id)->get();
        return response()->json([
            'data'=>view('employee.details', compact('employee','payroll'))->render(),
        ]);
    }//End Method



    //Insert Employees
    public function InsertEmployees(Request $req){
        $req->validate([
            "name" => 'required',
            "email" => 'required|email|unique:user__infos,user_email,email',
            "phone" => 'required|numeric|unique:user__infos,user_phone,phone',
            "gender" => 'required|in:male,female,others',
            "location" => 'required',
            "type" => 'required',
            "department" => 'required',
            "designation" => 'required',
            "dob" => 'required',
            "nid" => 'required',
            "address" => 'required',
            "image" => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        //generates Auto Increment Employee Id
        $latestEmployee = User_Info::where('user_type','employee')->orderBy('added_at','desc')->first();
        $id = ($latestEmployee) ? 'E' . str_pad((intval(substr($latestEmployee->user_id, 1)) + 1), 9, '0', STR_PAD_LEFT) : 'E000000101';

        //process the image name and store it to storage/app/public/profiles directory
        if ($req->hasFile('image') && $req->file('image')->isValid()) {
            $originalName = $req->file('image')->getClientOriginalName();
            $imageName = $id. '('. $req->name . ').' . $req->file('image')->getClientOriginalExtension();
            $imagePath = $req->file('image')->storeAs('public/profiles', $imageName);
        }
        else{
            $imageName = null;
        }

        User_Info::insert([
            "user_id" => $id,
            "user_name" => $req->name,
            "user_email" => $req->email,
            "user_phone" => $req->phone,
            "gender" => $req->gender,
            "loc_id" => $req->location,
            "user_type" => 'employee',
            "tran_user_type" => $req->type,
            "dob" => $req->dob,
            "nid" => $req->nid,
            "address" => $req->address,
            "image" => $imageName,
        ]);

        return response()->json([
            'status'=>'success',
        ]);
    }//End Method



    //Edit Employees
    public function EditEmployees(Request $req){
        $employee = User_Info::with('Department','Designation','Location')->findOrFail($req->id);
        $tranwith = Transaction_With::where('user_type','Employee')->get();
        return response()->json([
            'employee'=>$employee,
            'tranwith'=>$tranwith,
        ]);
    }//End Method



    //Update Employees
    public function UpdateEmployees(Request $req){
        $req->validate([
            "name" => 'required',
            "email" => ['required','email',Rule::unique('user__infos', 'user_email')->ignore($req->id)],
            "phone" => ['required','numeric',Rule::unique('user__infos', 'user_phone')->ignore($req->id)],
            "gender" => 'required|in:male,female,others',
            "location" => 'required',
            "type" => 'required',
            "department" => 'required',
            "designation" => 'required',
            "dob" => 'required',
            "nid" => 'required',
            "address" => 'required',
        ]);

        $employee = User_Info::findOrFail($req->id);
        $path = 'public/profiles/'.$employee->image;
        // dd($path);
        if($req->image != null){
            $req->validate([
                "image" => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            ]);

            //process the image name and store it to storage/app/public/profiles directory
            if ($req->hasFile('image') && $req->file('image')->isValid()) {
                Storage::delete($path);
                $imageName = $req->empId. '('. $req->name . ').' . $req->file('image')->getClientOriginalExtension();
                $imagePath = $req->file('image')->storeAs('public/profiles', $imageName);
            }
        }
        else{
            $imageName = $employee->image;
        }
        
        

        $update = User_Info::findOrFail($req->id)->update([
            "user_name" => $req->name,
            "user_email" => $req->email,
            "user_phone" => $req->phone,
            "gender" => $req->gender,
            "loc_id" => $req->location,
            "user_type" => 'employee',
            "tran_user_type" => $req->type,
            "dept_id" => $req->department,
            "designation_id" => $req->designation,
            "dob" => $req->dob,
            "nid" => $req->nid,
            "address" => $req->address,
            "image" => $imageName,
            "updated_at" => now()
        ]);
        if($update){
            return response()->json([
                'status'=>'success'
            ]); 
        }
    }//End Method



    //Delete Employees
    public function DeleteEmployees(Request $req){
        User_Info::findOrFail($req->id)->delete();
        return response()->json([
            'status'=>'success'
        ]); 
    }//End Method



    //Employee Pagination
    public function EmployeePagination(){
        $employee = User_info::where('user_type','employee')->orderBy('added_at','asc')->paginate(15);
        return response()->json([
            'status' => 'success',
            'data' => view('employee.employeePagination', compact('employee'))->render(),
        ]);
    }//End Method



    // Search Employee by Name
    public function SearchEmployees(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByEmail(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByPhone(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByLocation(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByAddress(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByDob(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
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
    public function SearchEmployeeByNid(Request $request){
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
                'data' => view('employee.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    // Search Employee by Department
    public function SearchEmployeeByDepartment(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Department')
            ->whereHas('Department', function ($query) use ($request) {
                $query->where('dept_name', 'like', '%'.$request->search.'%');
                $query->orderBy('dept_name','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Department')
            ->whereHas('Department', function ($query) use ($request) {
                $query->orderBy('dept_name','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('employee.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method


    // Search Employee by Designation
    public function SearchEmployeeByDesignation(Request $request){
        if($request->search != ""){
            $employee = User_Info::with('Designation')
            ->whereHas('Designation', function ($query) use ($request) {
                $query->where('designation', 'like', '%'.$request->search.'%');
                $query->orderBy('designation','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }
        else{
            $employee = User_Info::with('Designation')
            ->whereHas('Designation', function ($query) use ($request) {
                $query->orderBy('designation','asc');
            })
            ->where('user_type','employee')
            ->paginate(15);
        }

        $paginationHtml = $employee->links()->toHtml();
        
        if($employee->count() >= 1){
            return response()->json([
                'status' => 'success',
                'data' => view('employee.search', compact('employee'))->render(),
                'paginate' =>$paginationHtml
            ]);
        }
        else{
            return response()->json([
                'status'=>'null'
            ]); 
        }
    }//End Method



    /////////////////////////// --------------- Employee Table Methods end ---------- //////////////////////////


    
}
