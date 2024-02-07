<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee_Info;
use Illuminate\Support\Facades\File;

class EmployeeInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/employee_info.json");
        $employees = collect(json_decode($json));

        $employees->each(function($employee){
            Employee_Info::create([
                "emp_id"=>$employee->emp_id,
                "emp_name"=>$employee->emp_name,
                "emp_email"=>$employee->emp_email,
                "emp_phone"=>$employee->emp_phone,
                "loc_id"=>$employee->loc_id,
                "emp_type"=>$employee->emp_type,
                "dept_id"=>$employee->dept_id,
                "designation_id"=>$employee->designation_id,
                "dob"=>$employee->dob,
                "address"=>$employee->address,
                "image"=>$employee->image,
            ]);
        });
    }
}
