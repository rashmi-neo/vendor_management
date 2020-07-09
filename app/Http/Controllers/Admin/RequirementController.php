<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Vendor;
use App\Http\Requests\StoreRequirementRequest;
use App\Model\AssignVendor;
use App\Model\Requirement;
use DataTables;
use Exception;
use App\Repositories\Requirement\RequirementInterface as RequirementInterface;


class RequirementController extends Controller
{

	/**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\RequirementRepository
    */
    private $requirementRepository;

    public function __construct(RequirementInterface $requirementRepository){
        $this->requirementRepository = $requirementRepository;
    }


    /**
    * Index page of vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request;
    * @return void
    */
    public function index(Request $request){
        // $data = $this->requirementRepository->all();
        // dd($data);
        // foreach($data as $data1)
        // {
        //     dd($data1->category->name);
        // }
        if($request->ajax()){
            $data = $this->requirementRepository->all();

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row){
                return date('d/m/y', strtotime($row->created_at) );
            })
            ->editColumn('category_id', function ($row){
                // foreach($row as $data1)
                // {
                //     return $data1;
                // }
               return $row->category->name;
            })
            ->addColumn('action', function($row){
                return view('admin.requirement.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('admin.requirement.index');
    }

     /**
    * Create requirement form.
    *@author Bharti<bharati.tadvi@neosofttech.com>
    *
    *@return $categories,$vendors
    */
    public function create()
	{
		$categories = Category::where('status',1)->get();
     //   $vendors = Vendor::get();

		return view('admin.requirement.create',compact('categories'));
	}

	/**
    * Store Requirement details.
    *@author Bharti<bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return void
    */
    public function store(StoreRequirementRequest $request){

        $requestData =$request;
        try {
            $requirement = $this->requirementRepository->save($requestData);
            return redirect()->route('requirements.index')->with('success','Requirement details saved successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
    * showing edit requirement page.
    *@author Vikas<vikas.salekar@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return void
    */
    public function edit($id){
        $requirementEditDetails = $this->requirementRepository->get($id);
        $categories = Category::where('status',1)->get();
        // $vendorDetails = Requirement::with('vendor')->where('id',$id)->get();
        // dd($vendorDetails);
       // $vendorDetails = AssignVendor::with("vendor")->where('requirement_id',$id)->where('deleted_at',null)->get();
       $vendorDetails = Vendor::join('vms_assign_vendors','vms_vendors.id','=','vms_assign_vendors.vendor_id')
       ->join('vms_requirements','vms_assign_vendors.requirement_id','=','vms_requirements.id')
       ->select('vms_vendors.id','vms_vendors.first_name','vms_vendors.middle_name','vms_vendors.last_name')
       ->where('vms_assign_vendors.requirement_id',$id)
       ->where('vms_assign_vendors.deleted_at',null)
       ->get();
    //   dd( $vendorDetails);
        // $vendorDetails = $this->requirementRepository->getVendorDetails($id);
        return view('admin.requirement.edit',compact('requirementEditDetails','categories','vendorDetails'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(StoreRequirementRequest $request, $id)
    {
        $requestData = $request;
        try{
            $requirements = $this->requirementRepository->update($id,$requestData);
            if($requirements){
                return redirect()->route('requirements.index')->with('success', 'Requirement is successfully updated');
            }
            return redirect()->route('requirements.index')->with('error','Requirement not found');
        }catch(Exception $ex){
            return redirect()->route('requirements.index')->with('error',$ex->getMessage());
        }
    }

    /**
    * getting vendors as per category id.
    *@author Vikas<vikas.salekar@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return void
    */
    public function getVendorDetails($id)
    {
        $vendorDetails = $this->requirementRepository->getVendorDetails($id);
        return response()->json($vendorDetails);
    }

    public function show($id)
    {
            return view('admin.requirement.show');
    }
}
