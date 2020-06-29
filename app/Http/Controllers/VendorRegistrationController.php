<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Vendor\VendorInterface as VendorInterface;

class VendorRegistrationController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\VendorRepository
    */ 
    private $vendorRepository;

    public function __construct(VendorInterface $vendorRepository){
        $this->vendorRepository = $vendorRepository;
    }

    /**
    * Show the registration form.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return void
    */
    public function register(){
        return view('vendor.registration');
    }

    /**
    * Validate vendor registration.
    *@author Bharti<bharati.tadvi@neosofttech.com>
    * 
    * @param $userRequest
    * @return $validatedData
    */
    protected function validateUserRegister($userRequest){

        $validatedData = $userRequest->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required',
            'mobile_number' => 'required',
            'profile_image' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'contact_number' => 'required',
            'fax' => 'required',
            'website' => 'required',
        ]);
        return $validatedData;
    }

    /**
    * Store vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return 
    */
    public function store(Request $request){
        $validationRules = $this->validateUserRegister($request);
        try {
            $vendorRegister = $this->vendorRepository->save($request);
            return redirect()->back()->with('success','Registration done successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error',$ex->getMessage);
        }
    }
}
