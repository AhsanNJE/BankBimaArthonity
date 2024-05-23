<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_Head extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Groupe(){
        return $this->belongsTo(Transaction_Groupe::class,'groupe_id','id');
    }
    public function Category(){
        return $this->belongsTo(Category_Name::class,'category_id','id');
    }
    public function Manufecture(){
        return $this->belongsTo(Manufacturer_Info::class,'manufacture_id','id');
    }
    public function ItemForm(){
        return $this->belongsTo(Item__Form::class,'item_form_id','id');
    }
    public function ItemUnit(){
        return $this->belongsTo(Item__Unit::class,'item_unite_id','id');
    }
}
