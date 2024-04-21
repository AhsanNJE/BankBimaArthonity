<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Department(){
        return $this->belongsTo(Department_Info::class,'dept_id','id');
    }

    public function Location(){
        return $this->belongsTo(Location_Info::class,'loc_id','id');
    }

    public function Designation(){
        return $this->belongsTo(Designation::class,'designation_id','id');
    }


    public function Withs(){
        return $this->belongsTo(Transaction_With::class,'tran_user_type','id');
    }

    ///// client base due find for user_type User_Info Table /////////
    
    public function transaction()
    {
        return $this->hasMany(Transaction_Main::class, 'tran_user', 'user_id');
    }

    
}
