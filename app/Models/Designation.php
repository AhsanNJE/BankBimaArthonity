<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Department(){
        return $this->belongsTo(Department_Info::class,'dept_id','id');
    }
}
