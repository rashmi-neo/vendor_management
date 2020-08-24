<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\ReviewRating\ReviewRatingInterface as ReviewRatingInterface;


class ReviewRatingController extends Controller
{
    
	/**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@return \App\Repositories\ReviewRating\ReviewRatingRepository
    */
    private $reviewRatingRepository;

    public function __construct(ReviewRatingInterface $reviewRatingRepository){
        $this->reviewRatingRepository = $reviewRatingRepository;
    }

    /**
    * Index page of review and rating.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request;
    *@return Datatables
    */
    public function index(Request $request){

        if($request->ajax()){
            
            $currentUser = \Auth::user();
            $whereData = ['user_id'=>$currentUser->id];
            $data = $this->reviewRatingRepository->getVendorRating($whereData);
            
            return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('requirement_id', function($data){
                return $data->requirement->code;
            })
            ->addColumn('requirement_title', function($data){
                return $data->requirement->title;
            })
            ->addColumn('category', function($data){
                return $data->requirement->category->name;
            })
            ->addColumn('rating_star', function($row){
                return view('vendorUser.reviews_and_ratings.star_rating', compact('row'));
            })
            ->addColumn('action', function($row){
                return view('vendorUser.reviews_and_ratings.actions', compact('row'));
            })
            ->make(true);
        }
    	return view('vendorUser.reviews_and_ratings.index');
    }

    /**
    * Show page of specified review and rating.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  $id;
    *@return $reviewAndRating
    */
    public function show($id){
        
        $reviewAndRating = $this->reviewRatingRepository->find($id);
        
        try {
            if($reviewAndRating){
    	        return view('vendorUser.reviews_and_ratings.show',compact('reviewAndRating'));
            }else{
                return redirect()->route('vendor.reviews.index')->with('error', 'Review and rating not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('vendor.reviews.index')->with('error', 'Something went wrong!');
        }
    }

}
