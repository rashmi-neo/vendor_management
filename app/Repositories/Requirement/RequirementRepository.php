<?php

namespace App\Repositories\Requirement;
use App\Model\Requirement;
use App\Model\AssignVendor;
use App\Model\Category;
use App\Model\Vendor;
use App\Model\VendorCategory;
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
        return Requirement::find($id);
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
    	$requirement = Requirement::with("category")->get();
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
        $requirementObj->description = $data->description;
        $requirementObj->comment = $data->comment;
        $requirementObj->budget = $data->budget;
        $requirementObj->from_date =  $data->fromDate;
        $requirementObj->to_date = $data->toDate;
        $requirementObj->priority = $data->priority;
        $vendors = $data->vendor_id;

        if ($document = $data->file('proposal_document')) {
            $path = 'images';
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

        return  $requirementObj;
    }


    /**
     * Updates a Requirement.
     *
     * @param int
     * @param $array
     */
    public function update($id,$data)
    {

        $requirementObj = Requirement::find($id);
        //$requirementObj = Requirement::find($id)->update($data);

        $requirementObj->category_id = $data->category_id;
     //   $requirementObj->code = getRequirementCode();
        $requirementObj->title = $data->title;
        $requirementObj->description = $data->description;
        $requirementObj->comment = $data->comment;
        $requirementObj->budget = $data->budget;
        $requirementObj->from_date =  $data->fromDate;
        $requirementObj->to_date = $data->toDate;
        $requirementObj->priority = $data->priority;
        $vendors = $data->vendor_id;
        if ($document = $data->file('proposal_document')) {
            $path = 'images';
            $fileName = uploadFile($document,$path);
            $requirementObj->proposal_document = $fileName;
        }
        $requirementObj->save();

        foreach($vendors as $vendor){
           // dd($vendor);
            $assignVendor = AssignVendor::where('vendor_id',$vendor)->where('requirement_id',$requirementObj->id)->where('deleted_at',null)->get();
          //  dd(count($assignVendor));
            if ((count($assignVendor)>0)) {
                // echo "ok";
                // die;
                $assignVendor =AssignVendor::where('vendor_id',$vendor)->where('requirement_id',$requirementObj->id)->delete();
            }
            else
            {
                // echo "oasssk";
                // die;
                // $assignVendor->vendor_id = $vendor;
                // $assignVendor->requirement_id = $requirementObj->id;
                // $assignVendor->save();
                AssignVendor::create(['vendor_id'=>$vendor,'requirement_id'=>$requirementObj->id]);
            }

            //    $assignVendor->delete();
                // dd($assignVendor);
            // $assignVendor = AssignVendor::find($vendor);

             /* if($assignVendor->vendor_id == $vendor  && $assignVendor->requirement_id == $requirementObj->id)
             {
                if ($assignVendor != null) {
                $assignVendor->delete();
                // $assignVendor->vendor_id = $vendor;
                // $assignVendor->requirement_id = $requirementObj->id;
                // $assignVendor->save();
                }
            } */
            // $assignVendor->vendor_id = $vendor;
            // $assignVendor->requirement_id = $requirementObj->id;
            // $assignVendor->save();
          //  AssignVendor::where('requirement_id',$requirementObj->id)->update(['vendor_id'=>$vendor,'requirement_id'=>$requirementObj->id]);
        }
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
}
