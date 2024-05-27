<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item_Form;
use Illuminate\Support\Facades\File;

class ItemFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/json/item_form.json");
        $forms = collect(json_decode($json));

        $forms->each(function($form){
            Item_Form::create([
                "form_name"=>$form->form_name,
            ]);
        });
    }
}
