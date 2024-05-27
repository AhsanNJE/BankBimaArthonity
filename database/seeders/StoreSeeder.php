<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use Illuminate\Support\Facades\File;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/store.json");
        $stores = collect(json_decode($json));

        $stores->each(function($store){
            Store::create([
                "store_name"=>$store->store_name,
                "division"=>$store->division,
                "location_id"=>$store->location,
            ]);
        });
    }
}
