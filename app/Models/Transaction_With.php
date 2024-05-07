<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_With extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Type(){
        return $this->belongsTo(Transaction_Type::class,'tran_type','id');
    }
    
}
