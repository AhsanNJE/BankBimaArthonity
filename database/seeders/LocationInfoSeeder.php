<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location_Info;
use Illuminate\Support\Facades\File;

class LocationInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/location_info.json");
        $locations = collect(json_decode($json));

        $locations->each(function($location){
            Location_Info::create([
                "division"=>$location->division,
                "district"=>$location->district,
                "thana"=>$location->thana,
            ]);
        });
    }
}
