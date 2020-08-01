<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\User;
use App\Model\Vendor;
use App\Http\Requests\StoreRequirementRequest;
use App\Http\Requests\UpdateRequirementRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\PaymentReceiptRequest;
use App\Model\AssignVendor;
use App\Model\Requirement;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Exception;
use App\Repositories\Requirement\RequirementInterface as RequirementInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;
use Config;
use App\Model\VendorQuotation;
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
        $username =\Auth::user()->username;
        try {
            $requirement = $this->requirementRepository->save($requestData);
            $emailResp = $this->sendMailToVendor($requestData,$requirement->title);
            //send notification to vendors
             $vendorsIds = $requestData->vendor_id;
             $getVendorsData = Vendor::whereIn('id',$vendorsIds)->get();
            foreach($getVendorsData as $vendor)
            {
                $data = ['user_id'=>$vendor->user_id,'title'=>Config::get('constants.NEW_REQUIREMENT.title'),'text'=>Config::get('constants.NEW_REQUIREMENT.text').' '.$username,'type'=>Config::get('constants.NEW_REQUIREMENT.type'),'status'=>Config::get('constants.NEW_REQUIREMENT.status')];
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

        $getQuotationStatus = $this->requirementRepository->getQuotationStatus($id);

        return view('admin.requirement.show',compact("showRequirementDetails","requirementVendors","getQuotationStatus"));
    }

    public function sendMailToVendor($requestData,$requirementTitle)
    {
        $vendors = $requestData->vendor_id;
        $vendorEmail = Vendor::with('user')->whereIn('id',$vendors)->get();
        foreach($vendorEmail as $vendor)
        {
            $details['email'] = $vendor->user->email;
            $details['subject']='New Requirement';
            $message = 'Dear '.ucfirst($vendor->first_name);
            $message .=', There is new requirement "'.$requirementTitle.'". Please check your portal account for further details.';
            $details['body'] = $message;
            $details['from']='vikas.salekat@neosofttech.com';
            dispatch(new \App\Jobs\SendMailToVendor($details))->delay(now()->addSeconds(5));
        }
    }
    public function addComment(StoreCommentRequest $request )
    {
        try{
            $addComment = $this->requirementRepository->addComment($request);
            
            if($addComment){
                $assignvendor =AssignVendor::where('id',$addComment->assign_vendor_id)->first();
                $vendor =vendor::where('id',$assignvendor->vendor_id)->first();
                
                $notification = Config::get('constants.ADMIN_COMMENT');
                $admin = User::where('id',\Auth::user()->id)->first();
                $userName = $admin->username;

                if($admin)
                {
                    $notificationDetail = ['user_id'=>$vendor->id,'title'=>$notification['title'],'text'=>$userName.' '.$notification['text'],
                    'type'=>$notification['type'],'status'=>$notification['status']]; 
                    $notification = $this->notificationRepository->save($notificationDetail);
                }
            }
            if($addComment){
                return redirect()->route('requirements.show')->with('success', 'Comment added successfully');
            }
            return redirect()->route('requirements.show')->with('error','Error in add comment');
        }
        catch(Exception $ex){
            return redirect()->route('requirements.index')->with('error',$ex->getMessage());
        }
    }

    public function showQuotation($requirementId,$vendorAssignId)
    {
        $showQuotationDetails = $this->requirementRepository->showQuotationDetails($vendorAssignId);
        $requirement_id =$requirementId;
        return view('admin.requirement.showQuotation',compact("showQuotationDetails",'requirement_id'));
    }
    
    /**
    * Update Quotation status.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return true
    */
    public function updateStatus(Request $request){
        
        $assignVendors = AssignVendor::with('requirement')
        ->where('requirement_id',$request->requirementId)->get();  
        
        foreach($assignVendors as $assignVendor){
            if($assignVendor->id == $request->assignVendorId){
                VendorQuotation::where('assign_vendor_id',$request->assignVendorId)
                ->where('id', $request->id)->update(['status'=>'approved']);
            }

            if($assignVendor->id != $request->assignVendorId){
                VendorQuotation::where('assign_vendor_id','=',$assignVendor->id)
                ->update(['status'=>'rejected']);
            }
        }
        return true;        
    }

    /**
    * Upload Payment receipt.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return $response
    */
    public function uploadPaymentReceipt(PaymentReceiptRequest $request){
        
        
        $paymentReceipt = $this->requirementRepository->paymentReceipt($request);
        

        if (!empty($paymentReceipt)) {
            $response = response()->json([
                'success' => true,
                'message' => "Payment receipt uploaded successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Payment requirement not found",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }


    public function updateRequirementStatus(Request $request){
        
        $requirementStatus = $this->requirementRepository->requirementStatus($request);
        
        if (!empty($requirementStatus)) {
            $response = response()->json([
                'success' => true,
                'message' => "Requirement status updated successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Requirement status not updated successfully",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }
}
