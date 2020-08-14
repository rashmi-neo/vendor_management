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
            }])->first();
        
        foreach($newRequirements->assignVendor as $assign){
            if(isset($assign->requirement)){
                $requirements[] = $assign->requirement;
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
     * Find a Quotation by Requirement's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return collection
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

    /**
     * Upload a New quotation
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return true,false
    */
    public function update($id,$data)
    {   
        
        $vendorId = Vendor::where('user_id',\Auth::user()->id)->first();
        
        $assignRequirement = AssignVendor::with('requirement')
        ->where('requirement_id',$id)
        ->whereIn('vendor_id',[$vendorId->id])->first();            
         
        $currentDate = date('Y-m-d');

        if($assignRequirement->requirement->from_date<= $currentDate && $currentDate <= $assignRequirement->requirement->to_date ){
            
            $vendorQuotation = new VendorQuotation();
            $vendorQuotation->assign_vendor_id = $assignRequirement->id;
            
            if ($document = $data->file('quotation')) {
                $path = '/';
                $file = uploadFile($document,$path);
                $vendorQuotation->quotation_doc = $file;
            }
            $vendorQuotation->comment = $data->vendor_comment;
            $vendorQuotation->save();  
            return  true;
        }
        else{
            return false;
        }
                    
    }

}