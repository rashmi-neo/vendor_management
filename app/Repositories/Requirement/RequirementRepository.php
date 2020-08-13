<?php

namespace App\Repositories\Requirement;
use App\Model\Requirement;
use App\Model\AssignVendor;
use App\Model\Category;
use App\Model\Vendor;
use App\Model\VendorCategory;
use App\Model\VendorQuotation;
use App\Model\Payment;
use App\Repositories\Requirement\RequirementInterface;

class RequirementRepository implements RequirementInterface{


    public $requirement;

    function __construct(Requirement $requirement) {
	$this->requirement = $requirement;
	}

    /**
     * Get's a requirement by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Requirement::with("vendor","category","payment")->find($id);
        
    }


    /**
     * Get's all requirement.
     *
     *@Author Pooja <pooja.lavhat@neosofttech.com>
     *@param  void
     *@return $requirement
     */
    public function all()
    {
    	$requirement = Requirement::with("category","reviewRating") ->where('deleted_at',null)->orderBy('id', 'desc')->get();
    	return $requirement;
    }


    /**
     * Save a requirement.
     *
     * @Author Bharati <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return $requirement
     */
    public function save($data)
    {

        $requirementObj = new Requirement();
        $requirementObj->category_id = $data->category_id;
        $requirementObj->code = getRequirementCode();
        $requirementObj->title = $data->title;
        if( $data->description == "" ||  $data->description == null)
        {
            $requirementObj->description = "";
        }
        else
        {
            $requirementObj->description = $data->description;
        }
        $requirementObj->comment = $data->comment;
        $requirementObj->budget = $data->budget;
        $requirementObj->from_date =  $data->fromDate;
        $requirementObj->to_date = $data->toDate;
        $requirementObj->priority = $data->priority;
        $vendors = $data->vendor_id;

        if ($document = $data->file('proposal_document')) {
            $path = '/';
            $data = uploadFile($document,$path);
            $requirementObj->proposal_document = $data;
        }
        $requirementObj->save();

        foreach($vendors as $vendor){
            $assignVendor = new AssignVendor();
            $assignVendor->vendor_id = $vendor;
            $assignVendor->requirement_id = $requirementObj->id;
            $assignVendor->save();
        }

       // $emailResp = $this->sendMailToVendor($data);

        return  $requirementObj;
    }


    /**
     * Updates a Requirement.
     *@Author Vikas <vikas.salekar@neosofttech.com>
     * @param int
     * @param $array
     */
    public function update($id,$data)
    {

        $requirementObj = Requirement::find($id);
        //$requirementObj = Requirement::find($id)->update($data);

       // $requirementObj->category_id = $data->category_id;
     //   $requirementObj->code = getRequirementCode();
        $requirementObj->title = $data->title;
        if( $data->description == "")
        {
            $requirementObj->description = "";
        }
        else
        {
            $requirementObj->description = $data->description;
        }
        $requirementObj->comment = $data->comment;
        $requirementObj->budget = $data->budget;
        $requirementObj->from_date =  $data->fromDate;
        $requirementObj->to_date = $data->toDate;
        $requirementObj->priority = $data->priority;
        $vendors = $data->vendor_id;
        if($data->file('proposal_document') != null)
        {
            if ($document = $data->file('proposal_document')) {
                $path = '/';
                $fileName = uploadFile($document,$path);
                $requirementObj->proposal_document = $fileName;
            }
        }

        //    $previousCategoryId = Requirement::where('id',$id)->select('category_id')->first();
        //    if($previousCategoryId['category_id'] != $data->category_id)
        //     {
        //         AssignVendor::where('requirement_id',$requirementObj->id)->delete();
        //         foreach($vendors as $vendor){
        //             AssignVendor::create(['vendor_id'=>$vendor,'requirement_id'=>$requirementObj->id]);
        //         }
        //     }
        //     else
        //     {
        //         $previousVendors = AssignVendor::where('requirement_id',$requirementObj->id)->where("deleted_at",null)->select('vendor_id')->get();
        //         if(count($vendors) < count($previousVendors))
        //         {
        //             AssignVendor::where('requirement_id',$requirementObj->id)->whereNotIn('vendor_id',$vendors)->delete();
        //         }
        //         elseif(count($vendors) > count($previousVendors)){
        //            foreach($previousVendors as $prevVendors)
        //            {
        //                foreach($vendors as $vendorVal)
        //                {
        //                     if($vendorVal != $prevVendors->vendor_id)
        //                     {
        //                         $newVendors[] =$vendorVal;
        //                     }
        //                }
        //            }
        //            foreach($newVendors as $vendor){
        //             AssignVendor::create(['vendor_id'=>$vendor,'requirement_id'=>$requirementObj->id]);
        //         }
        //     }
        // }
        $requirementObj->save();
        return  $requirementObj;
    }

    /**
     * Deletes a Requirement.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param int
     */
    public function delete($id)
    {
        Requirement::destroy($id);
    }

    /**
     * get vendors details as per category id.
     *
     * @Author Vikas <vikas.salekar@neosofttech.com>
     * @param int
     */
    public function getVendorDetails($id)
    {
         return VendorCategory::with('vendor')->where('category_id',$id)->where('deleted_at',NULL)->get();
    }

    /**
     * get all categories details.
     *
     * @Author Vikas <vikas.salekar@neosofttech.com>
     * @param int
     */
    public function getAllCategories()
    {
      //  return  Category::where('status',1) ->where('deleted_at',null)->get();
      return Category::where('status',1)->get()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name','id');
    }

     /**
     * get a list of assign vendors to particular requirements.
     * this funtion is different from getVendorDetailsAsPerRequirement()
     * in this funtion taken number of fileds for showing multiple details.
     * @Author Vikas <vikas.salekar@neosofttech.com>
     * @param int
     */
    public function getAssignVendors($id)
    {
        return  Requirement::join('vms_assign_vendors','vms_requirements.id','=','vms_assign_vendors.requirement_id')
        ->join('vms_vendors','vms_assign_vendors.vendor_id','=','vms_vendors.id')
        //->leftjoin('vms_vendor_quotation','vms_assign_vendors.id','=','vms_vendor_quotation.assign_vendor_id')
        ->select('vms_vendors.first_name','vms_vendors.middle_name','vms_vendors.last_name','vms_vendors.mobile_number','vms_requirements.code','vms_requirements.id as requirement_id','vms_assign_vendors.id as assign_vendors_id','vms_assign_vendors.vendor_id','vms_requirements.title')
        ->where('vms_assign_vendors.requirement_id',$id)
        ->where('vms_assign_vendors.deleted_at',null)
        ->where('vms_vendors.deleted_at',null)
        ->get();
    }

    /**
     * get vendor details as per requirement.
     *
     * @Author Vikas <vikas.salekar@neosofttech.com>
     * @param int
     */
    public function getVendorDetailsAsPerRequirement($id)
    {
        return  Vendor::join('vms_assign_vendors','vms_vendors.id','=','vms_assign_vendors.vendor_id')
        ->join('vms_requirements','vms_assign_vendors.requirement_id','=','vms_requirements.id')
        ->select('vms_vendors.id','vms_vendors.first_name','vms_vendors.middle_name','vms_vendors.last_name')
        ->where('vms_assign_vendors.requirement_id',$id)
        ->where('vms_assign_vendors.deleted_at',null)
        ->where('vms_requirements.deleted_at',null)
        ->pluck('first_name','id');
    }
    

    /**
     * Save the admin comment against vendor quotation.
     *
     * @Author Vikas <vikas.salekar@neosofttech.com>
     * @param $request
     * @return $vendorQuotationObj
     */
    public function addComment($request)
    {
        $quotationId = $request->id;
        $comment = $request->comment;
        $assignVendorId = $request->assignVendorId;

        if($quotationId != "" && $comment != "" &&  $assignVendorId != "")
        {
            
            $vendorQuotationObj = VendorQuotation::where('assign_vendor_id', $assignVendorId)
            ->where('id', $quotationId)->first();
            $vendorQuotationObj->admin_comment =$comment;
            $vendorQuotationObj->save();
            return $vendorQuotationObj;
        }
    }
    
    
    public function showQuotationDetails($vendorAssignId)
    {
        return VendorQuotation::where('deleted_at',null)->where('assign_vendor_id',$vendorAssignId)->get();
    }

    /**
     * Get approved quotation status with vendor
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return $quotationStatus
    */
    public function getQuotationStatus($id){
        
        $quotationStatus = AssignVendor::with(['vendor','vendorQuotation'=>function ($query){
            $query->where('deleted_at',null)->whereIn('status',['approved']);
        }])->where('requirement_id',$id)->get();
        return $quotationStatus;
    }
    
    /**
     * Upload Payment receipt and details
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $requestData
     * @return $payementReceipt
    */
    public function paymentReceipt($requestData){
        
        $payementReceipt= New Payment();
        $payementReceipt->vendor_id =$requestData->vendor_id;
        $payementReceipt->requirement_id =$requestData->requirement_id; 
        
        if ($paymentReceipt = $requestData->file('payment_file')) {
            $path = '/';
            $file = uploadFile($paymentReceipt,$path);
            $payementReceipt->receipt =$file; 
        }

        $payementReceipt->payment_date =$requestData->payment_date; 
        $payementReceipt->amount =$requestData->amount; 
        $payementReceipt->save();
        return $payementReceipt;

    }

    /**
     * Update requirement status
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $request
     * @return $updateRequirementStatus
    */
    public function requirementStatus($request){
        
        $updateRequirementStatus = Requirement::where('id',$request->requirementId) ->update(['status'=>$request->status]);;
        return $updateRequirementStatus;
    }
}
