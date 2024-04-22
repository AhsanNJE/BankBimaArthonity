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

    public function personalDetail()
    {
        return $this->belongsTo(PersonalDetail::class, 'user_id', 'employee_id');
    }

    public function educationDetail()
    {
        return $this->belongsTo(EducationDetail::class, 'user_id', 'emp_id');
    }

    public function trainingDetail()
    {
        return $this->belongsTo(TrainingDetail::class, 'user_id', 'emp_id');
    }

    public function experienceDetail()
    {
        return $this->belongsTo(ExperienceDetail::class, 'user_id', 'emp_id');
    }

    public function organizationDetail()
    {
        return $this->belongsTo(OrganizationDetail::class, 'user_id', 'emp_id');
    }

    ///// client base due find for user_type User_Info Table /////////
    
    public function transaction()
    {
        return $this->hasMany(Transaction_Main::class, 'tran_user', 'user_id');
    }

    
}
