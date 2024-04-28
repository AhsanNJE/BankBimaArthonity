<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_With_Groupe extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Withs(){
        return $this->belongsTo(Transaction_With::class,'with_id','id');
    }


    public function Groupe(){
        return $this->belongsTo(Transaction_Groupe::class,'groupe_id','id');
    }
}
