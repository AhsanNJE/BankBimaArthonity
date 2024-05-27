<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item_Unit;
use Illuminate\Support\Facades\File;

class ItemUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/item_unit.json");
        $units = collect(json_decode($json));

        $units->each(function($unit){
            Item_Unit::create([
                "unit_name"=>$unit->unit_name,
            ]);
        });
    }
}
