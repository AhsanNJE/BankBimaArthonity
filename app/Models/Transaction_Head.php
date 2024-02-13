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
}
