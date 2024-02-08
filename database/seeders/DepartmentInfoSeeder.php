<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department_Info;
use Illuminate\Support\Facades\File;

class DepartmentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/department_info.json");
        $departments = collect(json_decode($json));

        $departments->each(function($department){
            Department_Info::create([
                "dept_name"=>$department->dept_name,
            ]);
        });
    }
}
