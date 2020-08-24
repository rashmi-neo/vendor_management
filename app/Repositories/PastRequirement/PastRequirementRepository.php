<?php

namespace App\Repositories\PastRequirement;
use App\Repositories\PastRequirement\PastRequirementInterface;
use App\Model\Vendor;
use App\Model\Requirement;
use App\Model\AssignVendor;
use App\Model\VendorQuotation;

class  PastRequirementRepository implements PastRequirementInterface{

   
    public $requirement;

    function __construct(Requirement $requirement) {
	$this->requirement = $requirement;
	}
   
    /**
     * Get's all Past requirements.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return $requirements
     */
    public function all()
    {
        $requirements = [];
        $id =\Auth::user()->id;
        
        $pastRequirements = Vendor::where('user_id',$id)->where('deleted_at',null)
         ->with(['assignVendor','assignVendor.requirement' => function ($query){
                $query->where('deleted_at',null)->whereIn('status',['completed','cancelled']);
            }])->first();
        
        foreach($pastRequirements->assignVendor as $assign){
            if(isset($assign->requirement)){
                $requirements[] = $assign->requirement;
            }
        }

        return $requirements;
    }

    /**
     * Get's a Past requirement by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return collection
     */
    public function find($id)
    {
        return Requirement::find($id);
    }

    /**
     * Find a Quotation by Requirement's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return $vendorQuotation
     */
    public function findQuotation($id){
        $vendorId = Vendor::where('user_id',\Auth::user()->id)->first();
        
        $assignRequirement = AssignVendor::with('requirement')
        ->where('requirement_id',$id)
        ->whereIn('vendor_id',[$vendorId->id])->first(); 
        
        $vendorQuotation = VendorQuotation::where('assign_vendor_id',$assignRequirement->id)
                ->get();
               
        return $vendorQuotation;
    }

}