<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction_With;
use Illuminate\Support\Facades\File;

class TransactionWithSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/tran_with.json");
        $tranwith = collect(json_decode($json));

        $tranwith->each(function($withs){
            Transaction_With::create([
                "tran_with_name"=>$withs->tran_with_name,
                "user_type"=>$withs->user_type,
                "tran_type"=>$withs->tran_type,
                "tran_method"=>$withs->tran_method,
            ]);
        });
    }
}
