<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Requirement;
use App\Model\User;

class DashboardController extends Controller
{
   
    public function index(){
        
        $totalRequirement = Requirement::get();
        $countRequirement = $totalRequirement->count();
        
        $completedRequirement = Requirement::whereIn('status',['completed'])->get();
        $countCompletedRequirement = $completedRequirement->count();
        
        $newRequirement = Requirement::whereIn('status',['in_progress','approved'])->get();
        $countNewRequirement = $newRequirement->count();

        $users = User::where('is_verified','pending')->get();
        $countPendingVerification = $users->count();
        
        return view('admin.dashboard.dashboard',compact('countRequirement','countCompletedRequirement',
        'countNewRequirement','countPendingVerification'));
    }

}