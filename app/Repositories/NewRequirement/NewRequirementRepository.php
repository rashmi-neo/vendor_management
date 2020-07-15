<?php

namespace App\Repositories\NewRequirement;
use App\Repositories\NewRequirement\NewRequirementInterface;
use App\Model\Vendor;
use App\Model\Requirement;
use App\Model\VendorQuotation;
use App\Model\AssignVendor;


class  NewRequirementRepository implements NewRequirementInterface{

   
    public $requirement;

    function __construct(Requirement $requirement) {
	$this->requirement = $requirement;
	}
   
    /**
     * Get's all New requirements.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return 
     */
    public function all()
    {
        $requirements = [];
        $id =\Auth::user()->id;
        
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

        return $requirements;
    }

    /**
     * Get's a New requirement by it's ID
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
     * Updates a New requirement
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return 
    */
    public function update($id,$data)
    {   
        
        
        $assignRequirementId = AssignVendor::where('requirement_id',$id)->first();            
        
        $vendorQuotation = new VendorQuotation();
        $vendorQuotation->assign_vendor_id = $assignRequirementId->id;
        if ($document = $data->file('quotation')) {
            $path = 'uploads';
            $file = uploadFile($document,$path);
            $vendorQuotation->quatation_doc = $file;
        }
        
        $vendorQuotation->comment = $data->vendor_comment;
        $vendorQuotation->save();            
            
        return  $vendorQuotation;
            
    }

}