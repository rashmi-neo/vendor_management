<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Model\Vendor;
use App\User;
use Config;
use App\Http\Requests\ReviewRatingRequest;
use App\Repositories\ReviewRating\ReviewRatingInterface as ReviewRatingInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;


class ReviewRatingController extends Controller
{
    
	/**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\ReviewRating\ReviewRatingRepository,\App\Repositories\Notifications\NotificationRepository
    */
    private $reviewRatingRepository;
    private $notificationRepository;

    public function __construct(ReviewRatingInterface $reviewRatingRepository,NotificationsInterface $notificationRepository){
        $this->reviewRatingRepository = $reviewRatingRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
    * Index page of Review and rating.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request;
    * @return Datatables
    */
    public function index(Request $request){

        if($request->ajax()){
            $data = $this->reviewRatingRepository->all();

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
            ->addColumn('vendor_name', function($data){
                return $data->vendor->first_name. ' '.$data->vendor->last_name;
            })
            ->addColumn('rating_star', function($row){
                return view('admin.reviewsAndRatings.star_rating', compact('row'));
            })
            ->make(true);
        }
    	return view('admin.reviewsAndRatings.index');
    }

    /**
    * Store rating and review .
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * @param Illuminate\Http\Request
    *@@return \Illuminate\Http\Response
    */
    public function save(ReviewRatingRequest $request){
        
        $saveReviewRating = $this->reviewRatingRepository->save($request->all());
 
        if (!empty($saveReviewRating)) {

            //send notification to vendor
            $vendor = vendor::where('id',$saveReviewRating->vendor_id)->first();
            
            $notification = Config::get('constants.ADMIN_RATING_REVIEW');
            $admin = User::where('id',\Auth::user()->id)->first();
            $userName = ucfirst($admin->username);

            if($admin)
            {
                $notificationDetail = ['user_id'=>$vendor->user_id,'title'=>$notification['title'],'text'=>$userName.' '.$notification['text'],
                'type'=>$notification['type'],'status'=>$notification['status']]; 
                $notification = $this->notificationRepository->save($notificationDetail);
            }

            $response = response()->json([
                'success' => true,
                'message' => "Review and rating added successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Review and rating not added successfully",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }
}
