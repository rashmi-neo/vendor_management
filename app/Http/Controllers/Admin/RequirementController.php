<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Vendor;
use App\Http\Requests\StoreRequirementRequest;
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
        if($request->ajax()){
            $data = $this->requirementRepository->all();

            return Datatables::of($data)
            ->addIndexColumn()
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
        $requirementDetails = $this->requirementRepository->get($id);
        dd($requirementDetails);
        return view('admin.requirement.edit',compact('requirementDetails'));
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
}
