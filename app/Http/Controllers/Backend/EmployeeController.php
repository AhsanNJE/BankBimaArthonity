<?php

namespace App\Http\Controllers\Backend;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Employee_Info;
use App\Models\Location_Info;
use App\Models\Department_Info;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{

    /////////////////////////// --------------- Departments Table Methods start ---------- //////////////////////////
    //Show All Departments
    public function ShowDepartments(){
        $department = Department_Info::orderBy('added_at','desc')->paginate(15);
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
            foreach($departments as $department) {
                $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$department->id.'">'.$department->dept_name.'</li>';
            }
        }
        else{
            $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
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
        $department = Department_Info::orderBy('added_at','desc')->paginate(15);
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
        $designations = Designation::orderBy('added_at','desc')->paginate(15);
        return view('employee.designation.designations', compact('designations'));
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
        $designations = Designation::orderBy('added_at','desc')->paginate(15);
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
        $location = Location_Info::orderBy('added_at','desc')->paginate(15);
        return view('employee.location.locations', compact('location'));
    }//End Method



    //Insert Locations
    public function InsertLocations(Request $req){
        $req->validate([
            "division" => 'required',
            "district" => 'required',
            "thana" => 'required',
        ]);

        Location_Info::insert([
            "division" => $req->division,
            "district" => $req->district,
            "thana" => $req->thana,
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
            "thana"  => 'required',
        ]);

        $update = Location_Info::findOrFail($req->id)->update([
            "district" => $req->district,
            "division" => $req->division,
            "thana" => $req->thana,
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
        $location = Location_Info::orderBy('added_at','desc')->paginate(15);
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



    //Search Location By Thana
    public function SearchLocationByThana(Request $req){
        $location = Location_Info::where('thana', 'like', '%'.$req->search.'%')
        ->orderBy('thana','asc')
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
    
    
    /////////////////////////// --------------- Employee Table Methods start ---------- //////////////////////////
    //Show All Employees
    public function ShowEmployees(){
        $employee = Employee_Info::orderBy('added_at','desc')->paginate(15);
        return view('employee.employees', compact('employee'));
    }//End Method



    // //Insert Unit
    // public function InsertUnits(Request $request){
    //     $request->validate([
    //         "unitName" => 'required|unique:inv__units,unit_name'
    //     ]);

    //     Inv_Unit::insert([
    //         "unit_name" => $request->unitName,
    //     ]);

    //     return response()->json([
    //         'status'=>'success',
    //     ]);  
    // }//End Method



    // //Get Unit by Name
    // public function GetUnitByName(Request $request){
    //     if($request->unit != ""){
    //         $inv_unit = Inv_unit::where('unit_name', 'like', '%'.$request->unit.'%')
    //         ->orderBy('unit_name','asc')
    //         ->take(10)
    //         ->get();

    //         if($inv_unit->count() > 0){
    //             $list = "";
    //             foreach($inv_unit as $unit) {
    //                 $list .= '<li class="list-group-item list-group-item-primary" data-id="'.$unit->id.'">'.$unit->unit_name.'</li>';
    //             }
    //         }
    //         else{
    //             $list = '<li class="list-group-item list-group-item-primary">No Data Found</li>';
    //         }
    //         return $list;
    //     }else{
    //         return "";
    //     } 
    // }//End Method



    // //Edit Unit
    // public function EditUnits($id){
    //     $inv_unit = Inv_Unit::findOrFail($id);
    //     return response()->json([
    //         'inv_unit'=>$inv_unit,
    //     ]);
    // }//End Method



    // //Update Unit
    // public function UpdateUnits(Request $request,$id){
    //     $inv_unit = Inv_Unit::findOrFail($id);

    //     $request->validate([
    //         "unitName" => ['required',Rule::unique('inv__units', 'unit_name')->ignore($inv_unit->id)],
    //         "status"=>'required|in:0,1'
    //     ]);

    //     $update = Inv_Unit::findOrFail($id)->update([
    //         "unit_name" => $request->unitName,
    //         "status" => $request->status,
    //         "updated_at" => now()
    //     ]);
    //     if($update){
    //         return response()->json([
    //             'status'=>'success'
    //         ]); 
    //     }
    // }//End Method



    // //Delete Unit
    // public function DeleteUnits($id){
    //     Inv_Unit::findOrFail($id)->delete();
    //     return response()->json([
    //         'status'=>'success'
    //     ]); 
    // }//End Method



    // //Unit Pagination
    // public function UnitPagination(){
    //     $inv_unit = Inv_Unit::orderBy('added_at','desc')->paginate(15);
    //     return response()->json([
    //         'status' => 'success',
    //         'data' => view('inventory.unit.unitPagination', compact('inv_unit'))->render(),
    //     ]);
    // }//End Method



    // //Unit Search
    // public function SearchUnits(Request $request){
    //     $inv_unit = Inv_Unit::where('unit_name', 'like', '%'.$request->search.'%')
    //     ->orWhere('id', 'like','%'.$request->search.'%')
    //     ->orderBy('unit_name','asc')
    //     ->paginate(15);
        
    //     if($inv_unit->count() >= 1){
    //         return response()->json([
    //             'status' => 'success',
    //             // 'pagination' => $inv_unit->links()->toHtml(),
    //             'data' => view('inventory.unit.searchUnit', compact('inv_unit'))->render(),
    //         ]);
    //     }
    //     else{
    //         return response()->json([
    //             'status'=>'null'
    //         ]); 
    //     }
    // }//End Method

    /////////////////////////// --------------- Employee Table Methods end ---------- //////////////////////////
}
