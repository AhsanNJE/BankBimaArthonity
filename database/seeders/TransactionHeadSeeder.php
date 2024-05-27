<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction_Head;
use Illuminate\Support\Facades\File;

class TransactionHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/tran_heads.json");
        $heads = collect(json_decode($json));

        $heads->each(function($head){
            Transaction_Head::create([
                "tran_head_name" => $head->tran_head_name,
                "groupe_id" => $head->groupe_id,
                "category_id" => $head->category_id,
                "manufacture_id" => $head->manufacture_id,
                "item_form_id" => $head->item_form_id,
                "store_id" => $head->store_id,
                "expired_date" => $head->expired_date,
            ]);
        });
    }
}
