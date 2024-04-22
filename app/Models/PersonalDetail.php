<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function educationDetail()
    {
        return $this->belongsTo(EducationDetail::class, 'employee_id', 'emp_id');
    }

    public function trainingDetail()
    {
        return $this->belongsTo(TrainingDetail::class, 'employee_id', 'emp_id');
    }

    public function experienceDetail()
    {
        return $this->belongsTo(ExperienceDetail::class, 'employee_id', 'emp_id');
    }

    public function organizationDetail()
    {
        return $this->belongsTo(OrganizationDetail::class, 'employee_id', 'emp_id');
    }


}
