<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User_Info::class,'emp_id','user_id');
    }

    public function Department(){
        return $this->belongsTo(Department_Info::class,'department','id');
    }

    public function Designation(){
        return $this->belongsTo(Designation::class,'designation','id');
    }

    public function Location(){
        return $this->belongsTo(Location_Info::class,'company_location','id');
    }
}
