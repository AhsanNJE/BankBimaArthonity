<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay_Roll_Setup extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Employee(){
        return $this->belongsTo(User_Info::class,'emp_id','user_id');
    }

    public function Head(){
        return $this->belongsTo(Transaction_Head::class,'head_id','id');
    }
}
