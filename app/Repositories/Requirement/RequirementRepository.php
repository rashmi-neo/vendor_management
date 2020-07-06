<?php

namespace App\Repositories\Requirement;
use App\Model\Requirement;
use App\Model\AssignVendor;
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
    	$requirement = Requirement::all();
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
        $requirementObj->code = insertCode();
        $requirementObj->title = $data->title;
        $requirementObj->description = $data->description;
        $requirementObj->comment = $data->comment;
        $requirementObj->budget = $data->budget;
        $requirementObj->from_date = "12/02/2020";
        $requirementObj->to_date = "26/02/2020";
        
        if ($document = $data->file('proposal_document')) {
            
            $destinationPath = storage_path('app/public/images');
            if(!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $extension = $document->getClientOriginalExtension();
            $documentOriginalName = $document->getClientOriginalName();
            $documentName = md5(uniqid($documentOriginalName)).'.'.$extension;
            $document->move($destinationPath, $documentName);
            $requirementObj->proposal_document = $documentName;
        }
        
        $requirementObj->save();
        
        $vendors = $data->vendor_id;
        
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
    public function update($id,array $data)
    {
        Requirement::find($id)->update($data);
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
}