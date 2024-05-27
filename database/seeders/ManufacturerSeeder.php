<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer_Info;
use Illuminate\Support\Facades\File;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/manufacturer.json");
        $manufacturers = collect(json_decode($json));

        $manufacturers->each(function($manufacturer){
            Manufacturer_Info::create([
                "manufacturer_name"=>$manufacturer->manufacturer_name,
            ]);
        });
    }
}
