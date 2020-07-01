<?php

namespace App\Http\Controllers;

use App\Repositories\Vendor\VendorInterface as VendorInterface;
use Illuminate\Http\Request;
use App\Http\Requests\VendorStoreRequest;
use App\Model\Category;



class VendorController extends Controller
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
        
        $categories = Category::where('status',1)->get();
         
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
            return redirect()->back()->with('success','Registration done successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error',$ex->getMessage);
        }
    }
}
