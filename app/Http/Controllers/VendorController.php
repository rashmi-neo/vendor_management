<?php

namespace App\Http\Controllers;

use App\Repositories\Vendor\VendorInterface as VendorInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;
use Illuminate\Http\Request;
use App\Http\Requests\VendorStoreRequest;
use App\Model\Category;
use App\Model\User;



class VendorController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\VendorRepository
    */ 
    private $vendorRepository;

    public function __construct(VendorInterface $vendorRepository,NotificationsInterface $notificationRepository)
    {
        $this->vendorRepository = $vendorRepository;
        $this->notificationRepository = $notificationRepository;
    }


    /**
    * Show the registration form.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return void
    */
    public function register(){
        
        $categories = $this->vendorRepository->getAllCategories();
        return view('vendorUser.registration',compact('categories'));
    }

    /**
    * Store vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return 
    */
    public function store(VendorStoreRequest $request){
        
        $requestData =$request;
        
        try {
            $vendorRegister = $this->vendorRepository->save($requestData);
            
            //send email
            $details['email'] = $requestData['email'];
            $details['subject']='Vendor registration';
            $details['body'] = 'Thank you for registering on Vendor management system.  We will get back to you once the verification is done.';
            $details['from']='Vendor Management System';
            dispatch(new \App\Jobs\SendEmailJob($details));
            
            //send notification to admin
            $adminId = User::where(['role_id'=>1])->first();
            if($adminId)
            {
                $data = ['user_id'=>$adminId->id,'title'=>'New Vendor Registered','text'=>'New vendor '.$requestData['first_name'].' '.$requestData['last_name'].' has been registered.','type'=>'vendor_register','status'=>'unread']; 
                $notification = $this->notificationRepository->save($data);
            }
            return redirect()->back()->with('success','Registration done successfully');
        } catch (Exception $ex) {
            return redirect()->back()->with('error',$ex->getMessage);
        }
    }
}
