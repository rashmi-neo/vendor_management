<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Model\Vendor;
use App\Model\VendorCategory;
use App\Repositories\Vendor\VendorInterface as VendorInterface;


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
    * Index page of vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    * @param void
    * @return void
    */
    public function index(Request $request){
        if($request->ajax()){
            $data = $this->vendorRepository->all();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($data){
                        return $data->first_name. ' ' .$data->last_name;
                    })
                    ->addColumn('category', function($data){
                        return $data->vendorCategory->category->name;
                    })
                    ->addColumn('contact_number', function($data){
                        return $data->company->contact_number;
                    })
                    ->addColumn('company_name', function($data){
                        return $data->company->company_name;
                    })
                    ->addColumn('action', function($row){
                        return view('admin.vendor.actions', compact('row'));
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    	return view('admin.vendor.index',compact('vendors'));
    }


    public function create()
	{
	   return view('admin.vendor.create');
	}

    /**
    * Show the form for editing the specified Vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $vendor
    */
    public function edit($id)
    {   
    	$vebdorId = $id;
    	$vendor = $this->vendorRepository->find($vebdorId);
    	return view('admin.vendor.edit',compact('vendor','vebdorId'));
    }

    /**
    * View the form of specified Vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $vendor
    */
    public function show($id)
    {
    	$vebdorId = $id;
    	$vendor = $this->vendorRepository->find($vebdorId);
    	return view('admin.vendor.show',compact('vendor','vebdorId'));
    }

}
