<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    

    public function create()
	{
	   return view('admin.requirement.create');
	}
}
