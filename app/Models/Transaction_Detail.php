<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction_Detail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User_Info::class,'tran_user','user_id');
    }

    public function Head(){
        return $this->belongsTo(Transaction_Head::class,'tran_head_id','id');
    }


    public function Groupe(){
        return $this->belongsTo(Transaction_Groupe::class,'tran_groupe_id','id');
    }


    public function Location(){
        return $this->belongsTo(Location_Info::class,'loc_id','id');
    }
}
