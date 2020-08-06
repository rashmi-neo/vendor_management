<?php

namespace App\Repositories\ReviewRating;
use App\Repositories\ReviewRating\ReviewRatingInterface;
use App\Model\ReviewRating;
use App\Model\Requirement;
use App\Model\AssignVendor;
use App\Model\Vendor;


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
     *@return $users
     */
    public function all(){
        
        return ReviewRating::with('vendor')->get();
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
        $reviewRatingObj->vendor_id = $assignVendor->vendor_id;
        $reviewRatingObj->review = $data['review'];
        $reviewRatingObj->rating = $data['rating'];
        $reviewRatingObj->save();
        return $reviewRatingObj;
    }
    
    public function findVendorRequirement($data){
        
        return AssignVendor::with(['vendor','requirement','vendorQuotation'=>function ($query){
            $query->where('deleted_at',null)->whereIn('status',['approved']);
        }])->where('requirement_id',$data['requirementId'])->first();
    }

    public function getVendorRating($data){
        $vendor = Vendor::where('user_id',$data)->first();

        $reviewRating = ReviewRating::where('vendor_id',$vendor->id)
                        ->with('vendor')->get();
        return $reviewRating;
    }

    public function find($id){
       return $reviewRating = ReviewRating::with('vendor')->find($id);
    }

}