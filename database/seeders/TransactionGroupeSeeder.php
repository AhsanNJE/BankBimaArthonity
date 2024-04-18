<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction_Groupe;
use Illuminate\Support\Facades\File;

class TransactionGroupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/tran_groupe.json");
        $groupes = collect(json_decode($json));

        $groupes->each(function($groupe){
            Transaction_Groupe::create([
                "tran_groupe_name"=>$groupe->tran_groupe_name,
                "tran_groupe_type"=>$groupe->tran_groupe_type,
            ]);
        });
    }
}
