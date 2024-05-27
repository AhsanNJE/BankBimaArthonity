<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category_Name;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/category_name.json");
        $categories = collect(json_decode($json));

        $categories->each(function($category){
            Category_Name::create([
                "category_name"=>$category->category_name,
            ]);
        });
    }
}
