<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard(){

        return view('admin.admin_master_dashboard');

    }//End Method
}
