<?php

namespace App\Repositories\PastRequirement;
use App\Repositories\PastRequirement\PastRequirementInterface;
use App\Model\Vendor;
use App\Model\Requirement;

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
     *@return 
     */
    public function all()
    {
        
        $id =\Auth::user()->id;
        
        $pastRequirements = Vendor::where('user_id',\Auth::user()->id)->with('vendorCategory','vendorCategory.category',
        'assignVendor','assignVendor.requirement')->get();
        return $pastRequirements;
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

}