<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationDetail extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function User(){
        return $this->belongsTo(User_Info::class,'emp_id','user_id');
    }
}
