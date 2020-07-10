<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Vendor;
use App\Http\Requests\StoreRequirementRequest;
use App\Http\Requests\UpdateRequirementRequest;
use App\Model\AssignVendor;
use App\Model\Requirement;
use DataTables;
use Exception;
use App\Repositories\Requirement\RequirementInterface as RequirementInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;

class RequirementController extends Controller
{

	/**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\RequirementRepository
    */
    private $requirementRepository;
    private $notificationRepository;

    public function __construct(RequirementInterface $requirementRepository,NotificationsInterface $notificationRepository){
        $this->requirementRepository = $requirementRepository;
        $this->notificationRepository = $notificationRepository;
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
            ->editColumn('created_at', function ($row){
                return date('d/m/y', strtotime($row->created_at) );
            })
            ->editColumn('category_id', function ($row){
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
    *@author  Vikas<vikas.salekar@neosofttech.com>
    *
    *@return $categories,$vendors
    */
    public function create()
	{
        $categories = $this->requirementRepository->getAllCategories();
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
            $emailResp = $this->sendMailToVendor($requestData);

            //Working on this module

            //send notification to vendors
             $vendorsIds = $requestData->vendor_id;
             $getVendorsData = Vendor::whereIn('id',$vendorsIds)->get();
            foreach($getVendorsData as $vendor)
            {
                $data = ['user_id'=>$vendor->user_id,'title'=>'Requirement assign to vendor','text'=>'Assign New Requirement from','type'=>'document_update','status'=>'unread'];
                $notification = $this->notificationRepository->save($data);
            }
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
        $categories = $this->requirementRepository->getAllCategories();
        $vendorDetails = $this->requirementRepository->getVendorDetailsAsPerRequirement($id);
        return view('admin.requirement.edit',compact('requirementEditDetails','categories','vendorDetails'));
    }

        /**
     * Update the specified resource in storage.
     *@author Vikas<vikas.salekar@neosofttech.com>
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(UpdateRequirementRequest $request, $id)
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

    /**
    * showing requirements details.
    *@author Vikas<vikas.salekar@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return void
    */
    public function show(Request $request,$id)
    {
        $showRequirementDetails = $this->requirementRepository->get($id);
        $requirementVendors = $this->requirementRepository->getAssignVendors($id);
        return view('admin.requirement.show',compact("showRequirementDetails","requirementVendors"));
    }

    public function sendMailToVendor($requestData)
    {
        $vendors = $requestData->vendor_id;
        $vendorEmail = Vendor::with('user')->whereIn('id',$vendors)->get();
        foreach($vendorEmail as $vendor)
        {
            $details['email'] = $vendor->user->email;
            $details['subject']='Requirement Assign';
            $details['body'] = 'please check the requirements';
            $details['from']='vikas.salekat@neosofttech.com';
            //$details['requestData']=$requestData;
            dispatch(new \App\Jobs\SendMailToVendor($details))->delay(now()->addSeconds(10));

        }
    }
}
