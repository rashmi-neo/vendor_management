<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Requirement;
use App\Model\User;

class DashboardController extends Controller
{
   
    /**
    * Show the count of total requirement,completed requirement, new requirement,pending verifications,  
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @return $countRequirement,countCompletedRequirement,countNewRequirement,countPendingVerification
    */
    public function index(){
        
        $countRequirement = Requirement::count();
        
        $countCompletedRequirement = Requirement::whereIn('status',['completed'])->count();
        
        $countNewRequirement = Requirement::whereIn('status',['in_progress','approved'])->count();

        $countPendingVerification = User::where('is_verified','pending')->count();
        
        return view('admin.dashboard.dashboard',compact('countRequirement','countCompletedRequirement',
        'countNewRequirement','countPendingVerification'));
    }

}
