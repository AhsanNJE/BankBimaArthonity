<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Designation;
use Illuminate\Support\Facades\File;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/designation.json");
        $designations = collect(json_decode($json));

        $designations->each(function($designation){
            Designation::create([
                "designation"=>$designation->designation,
                "dept_id"=>$designation->dept_id,
            ]);
        });
    }
}
