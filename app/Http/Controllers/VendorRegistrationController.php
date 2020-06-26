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
    * Store vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return 
    */
    public function store(Request $request){
        
        try {
            $vendorRegister = $this->vendorRepository->save($request);
            return redirect()->back()->with('success','Registration done successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error',$ex->getMessage);
        }
    }
}
