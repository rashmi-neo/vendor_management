<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;

class DashboardController extends Controller
{
    
    public function index(){
        
        $id =\Auth::user()->id;
        $requirements = [];
        $cancelRequirements = [];
        $completeRequirements = [];

        
        $newRequirements = Vendor::where('user_id',$id)->where('deleted_at',null)
         ->with(['assignVendor','assignVendor.requirement' => function ($query){
                $query->where('deleted_at',null)->whereIn('status',['in_progress','approved']);
            }])->get();

            foreach($newRequirements as $newRequirement){
                foreach($newRequirement->assignVendor as $assign){
                    if(isset($assign->requirement)){
                        $requirements[] = $assign->requirement;
                    }
                }
            }
     
        $newRequirementCount = count($requirements);
       

        $completedRequirements = Vendor::where('user_id',$id)->where('deleted_at',null)
         ->with(['assignVendor','assignVendor.requirement' => function ($query){
                $query->where('deleted_at',null)->whereIn('status',['completed']);
            }])->get();

            foreach($completedRequirements as $newRequirement){
                foreach($newRequirement->assignVendor as $assign){
                    if(isset($assign->requirement)){
                        $completeRequirements[] = $assign->requirement;
                    }
                }
            }
        
        $cancelledRequirements = Vendor::where('user_id',$id)->where('deleted_at',null)
        ->with(['assignVendor','assignVendor.requirement' => function ($query){
                $query->where('deleted_at',null)->whereIn('status',['cancelled']);
            }])->get();

            foreach($cancelledRequirements as $newRequirement){
                foreach($newRequirement->assignVendor as $assign){
                    if(isset($assign->requirement)){
                        $cancelRequirements[] = $assign->requirement;
                    }
                }
            }
    
        $completeRequirementCount = count($completeRequirements); 
        
        $cancelRequirementCount = count($cancelRequirements); 
        
        return view('vendorUser.dashboard.dashboard',compact('newRequirementCount','completeRequirementCount',
        'cancelRequirementCount'));
    }
    
    public function requirementCount($status){
        
    }
}
