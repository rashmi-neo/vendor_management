<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Response;
use App\Model\Vendor;
use App\Model\AssignVendor;
use App\Model\User;
use Mail;
use Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\VendorQuotationRequest;
use App\Repositories\NewRequirement\NewRequirementInterface as NewRequirementInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;

class NewRequirementController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\NewRequirementRepository
    */ 
    private $newRequirementRepository;

    public function __construct(NewRequirementInterface $newRequirementRepository,NotificationsInterface $notificationRepository){
        $this->newRequirementRepository = $newRequirementRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
    * Index page of New requirement.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    *@param  Illuminate\Http\Request;
    */
    public function index(Request $request){
        
        $categories = $this->findCategory();
        
        $categoryName = [];
        
        if($request->ajax()){
           
            $data = $this->newRequirementRepository->all();
           
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('priority',function ($row){
                return empty($row->priority)? "-":$row->priority;
            })
            ->editColumn('category_name', function ($row){
                return $row->category->name;
             })
            ->addColumn('action', function($row){
                return view('vendorUser.newRequirement.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('vendorUser.newRequirement.index');
    }

     /**
    * Show the form of specified Post requirement.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $pastRequirement
    */
    public function show(Request $request,$id){
        
        $category = $this->findCategory();
        $newRequirement = $this->newRequirementRepository->find($id);
        $vendorId = Vendor::where('user_id',\Auth::user()->id)->first();
        
        $assignVendor = AssignVendor::with('requirement')
        ->where('requirement_id',$newRequirement->id)
        ->whereIn('vendor_id',[$vendorId->id])->first();
        
        try {
            if($newRequirement){
    	        return view('vendorUser.newRequirement.show',compact('newRequirement','category','assignVendor'));
            }else{
                return redirect()->route('new.requirement.index')->with('error', 'New requirement not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('new.requirement.index')->with('error', 'Something went wrong!');
        }
    }

    public function findCategory(){
        
        $id =\Auth::user()->id;
        
        $categoryName = Vendor::where('user_id',$id)->where('deleted_at',null)
            ->with('vendorCategory','vendorCategory.category')->first();
        return $categoryName;
    }

    /**
    * Show the form for editing the specified New requirement.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $newRequirement
    */
    public function edit($id)
    {   
        
        $newRequirement = $this->newRequirementRepository->find($id);
        
        try {
            if($newRequirement){
    	        return view('vendorUser.newRequirement.edit',compact('newRequirement'));
            }else{
                return redirect()->route('new.requirement.index')->with('error', 'New requirement not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('new.requirement.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Save the Vendor quotation.
     *@Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  \Illuminate\Http\VendorQuotationRequest  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request,$id)
    {
                    
        $details =[];
        if($request->fromDate<=date('Y-m-d') && date('Y-m-d') <=  $request->toDate){            
            $validateData = $request->validate([
                'quotation' => 'required|file|max:10000|mimes:xls,pdf,xlsx',
            ]);
        }else{
            $response = response()->json([
                'success' => false,
                'message' => "You can upload quotation between start and to date only.",
                'data' => [
                'status_code' => 401
                ]
            ]);
            return $response;
        }
        
        try{
            $newRequirement = $this->newRequirementRepository->update($id,$request);
            
            $user = \Auth::user();
            $vendor = Vendor::where('user_id',$user->id)->first();
            
            //send notification to the admin
            $adminUser = User::where(['role_id'=>1])->first();
            
            $notification = \Config::get('constants.QUOTATION_DOCUMENT');
            
            if($adminUser)
            {
                $data = ['user_id'=>$adminUser->id,'title'=>$notification['title'],'text'=>$vendor->first_name.' '.$vendor->last_name.' '.$notification['text'],
                'type'=>$notification['type'],'status'=>$notification['status']]; 
                $notification = $this->notificationRepository->save($data);
            }
            
            /* Send mail to the admin*/
            $details['email'] = $adminUser->email;
            $details['subject']='A new quotation added';
            $message ='There is new quotation uploaded by '.$vendor->first_name.' '.$vendor->last_name. '. Please check your admin portal for further details.';
            $details['body'] = $message;
            $details['from']= $user->email;

            dispatch(new \App\Jobs\SendMailToAdmin($details));
            
            if (!empty($newRequirement)) {
                
                $response = response()->json([
                    'success' => true,
                    'message' => "Vendor uploaded quotation successfully.",
                ]);
            
                return $response;
            
            } else {
                $response = response()->json([
                    'success' => false,
                    'message' => "You can upload quotation between start and to date only.",
                    'data' => [
                    'status_code' => 401
                    ]
                ]);
    
                return $response;
            }
        }catch(\Exception $ex){
            
            $response = response()->json([
                'success' => false,
                'message' => "Something went wrong",
                'data' => [
                'status_code' => 401
                ]
            ]);
            return $response;
        }
    }

    /**
     * download Proposal document.
     *@Author Bharti <bharati.tadvi@neosofttech.com>
     * @param   $filename
     * @return $newFileName
     */
    public function getDocumentDownload($filename){
        
        $file = public_path(). "/uploads/".$filename;
        
        $newFileName = 'proposal-document'.time();

        return response()->download($file,$newFileName);

    }

    /**
    * Show the form of specified quotation.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $pastRequirement
    */
    public function showQuotationDetail(Request $request,$id){
        
        
        $quotations = $this->newRequirementRepository->findQuotation($id);
        
        try {
            if($quotations){
    	        return view('vendorUser.newRequirement.showQuotation',compact('quotations'));
            }else{
                return redirect()->route('new.requirement.index')->with('error', 'Quotation not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('new.requirement.index')->with('error', 'Something went wrong!');
        }
    }

}