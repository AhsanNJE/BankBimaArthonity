<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction_Type;
use Illuminate\Support\Facades\File;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/tran_type.json");
        $types = collect(json_decode($json));

        $types->each(function($type){
            Transaction_Type::create([
                "type_name"=>$type->type_name,
            ]);
        });
    }
}
