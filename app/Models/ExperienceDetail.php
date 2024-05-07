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

    public function personalDetail()
    {
        return $this->belongsTo(PersonalDetail::class, 'emp_id', 'employee_id');
    }
}
