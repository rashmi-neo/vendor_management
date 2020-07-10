<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VendorStoreRequest;
use App\Http\Requests\UpdateVendorRequest;
use DataTables;
use App\Model\Category;
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
    *@param  Illuminate\Http\Request;
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
            ->addColumn('verification_status', function($data){
                
                if($data->user->is_verified == "pending"){
                    return "Pending";
                }elseif($data->user->is_verified == "approved"){
                    return "Approved";
                }
                return "Rejected";
            })
            ->addColumn('action', function($row){
                return view('admin.vendor.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('admin.vendor.index');
    }

    /**
    * Create vendor form.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return $categories
    */
    public function create()
	{   
        $categories = Category::where('status',1)->get();
        
        return view('admin.vendor.create',compact('categories'));
    }
    
    /**
    * Store vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return void
    */
    public function store(VendorStoreRequest $request){
        
        $requestData =$request;
        
        try {
            $vendor = $this->vendorRepository->save($requestData);
            return redirect()->route('requirements.index')->with('success','Vendor details save successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    /**
    * Show the form for editing the specified Vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $vendor,$categories
    */
    public function edit($id)
    {   
        $vebdorId = $id;
        $categories = Category::where('status',1)->get();
        $vendor = $this->vendorRepository->find($vebdorId);
       
        try {
            if($vendor){
    	        return view('admin.vendor.edit',compact('vendor','categories'));
            }else{
                return redirect()->route('vendors.index')->with('error', 'Vendor not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('vendors.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        $requestData = $request;
        
        try{
            $vendor = $this->vendorRepository->update($id,$requestData);
            if($vendor){
                return redirect()->route('vendors.index')->with('success', 'Vendor is successfully updated');
            }
            return redirect()->route('vendors.index')->with('error','Vendor not found');
        }catch(\Exception $ex){
            return redirect()->route('vendors.index')->with('error','Something went wrong');
        }
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
        
        try {
            if($vendor){
                return view('admin.vendor.show',compact('vendor'));
            }else{
                return redirect()->route('vendors.index')->with('error', 'Vendor not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('vendors.index')->with('error', 'Something went wrong!');
        }
    }
}
