<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Heads(){
        return $this->belongsTo(Transaction_Head::class,'product_name','id');
    }

    public function Manufacturers(){
        return $this->belongsTo(Manufacturer_Info::class,'manufacturer_name','id');
    }

    public function Categories(){
        return $this->belongsTo(Category_Name::class,'category_name','id');
    }

}
