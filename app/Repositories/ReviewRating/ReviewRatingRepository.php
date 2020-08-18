<?php

namespace App\Repositories\ReviewRating;
use App\Repositories\ReviewRating\ReviewRatingInterface;
use App\Model\ReviewRating;
use App\Model\Requirement;
use App\Model\AssignVendor;
use App\Model\Vendor;
use App\Model\VendorQuotation;


class  ReviewRatingRepository implements ReviewRatingInterface{

   
    public $reviewRating;

    function __construct(ReviewRating $reviewRating) {
	$this->reviewRating = $reviewRating;
    }
    
    /**
     * Get's all reviews and ratings.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return collection
     */
    public function all(){
        
        return ReviewRating::with('vendor')->orderBy('id', 'desc')->get();
    }
    
    /**
     * Save review and rating
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $data
     * @return $reviewRatingObj
    */
    public function save($data){
        
        $assignVendor = $this->findVendorRequirement($data);
        
        $reviewRatingObj = new ReviewRating;
        $reviewRatingObj->requirement_id = $data['requirementId'];
        $reviewRatingObj->vendor_id = $assignVendor;
        $reviewRatingObj->review = $data['review'];
        $reviewRatingObj->rating = $data['rating'];
        $reviewRatingObj->save();
        return $reviewRatingObj;
    }
    

    /**
     * Find vendor who's requirement status is approved 
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $data
     * @return collection
    */
    public function findVendorRequirement($data){
       
        $assignVendor = AssignVendor::where('requirement_id',$data['requirementId'])->with(['vendor','requirement','vendorQuotation'=>function ($query){
            $query->where('deleted_at',null)->where('status','approved');
        }])->get();

        foreach($assignVendor as $datarequire){
            if(!$datarequire->vendorQuotation->isEmpty()){
                $vendor_id = $datarequire->vendor_id;
            } 
        }
        return $vendor_id;     
    }


    /**
     * Get's a vendor rating as per login vendor
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $data
     * @return $reviewRating
    */
    public function getVendorRating($data){
        $vendor = Vendor::where('user_id',$data)->first();

        $reviewRating = ReviewRating::where('vendor_id',$vendor->id)
                        ->with('vendor')->get();
        return $reviewRating;
    }

    /**
     * Find review and rating
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return collection
    */
    public function find($id){
       return $reviewRating = ReviewRating::find($id);
    }

}