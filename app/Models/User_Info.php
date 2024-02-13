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
}
