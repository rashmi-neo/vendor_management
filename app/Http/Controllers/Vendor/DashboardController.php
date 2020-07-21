<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;

class DashboardController extends Controller
{
    
    /**
    * Get logged in Vendor requirement count.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    *
    *@return $newRequirementCount,$completeRequirementCount,$cancelRequirementCount
    */
    public function index(){
        
        $id =\Auth::user()->id;
        
        $newRequirement = Vendor::withCount(['requirements' => function ($query){
            $query->where('vms_requirements.deleted_at',null)->whereIn('vms_requirements.status',['in_progress','approved']);
            }])->where('user_id',$id)->where('vms_vendors.deleted_at',null)->first();
        
        $completedRequirement = Vendor::withCount(['requirements' => function ($query){
            $query->where('vms_requirements.deleted_at',null)->whereIn('vms_requirements.status',['completed']);
            }])->where('user_id',$id)->where('vms_vendors.deleted_at',null)->first();
    
        $cancelledRequirement = Vendor::withCount(['requirements' => function ($query){
            $query->where('vms_requirements.deleted_at',null)->whereIn('vms_requirements.status',['cancelled']);
            }])->where('user_id',$id)->where('vms_vendors.deleted_at',null)->first();
    
    
        $newRequirementCount = $newRequirement->requirements_count; 

        $completeRequirementCount = $completedRequirement->requirements_count; 
        
        $cancelRequirementCount = $cancelledRequirement->requirements_count; 
        
        
        return view('vendorUser.dashboard.dashboard',compact('newRequirementCount','completeRequirementCount',
        'cancelRequirementCount'));
    }
    
}
