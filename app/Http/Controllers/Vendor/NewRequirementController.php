<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Response;
use App\Model\Vendor;
use App\Model\User;
use Mail;
use Session;
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

            ->addColumn('category_name', function($data) use ($categories){
               
                foreach($categories->vendorCategory as $category){
                    $categoryName[] = $category->category->name;
                }
                return $categoryName;
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
        
        try {
            if($newRequirement){
    	        return view('vendorUser.newRequirement.show',compact('newRequirement','category'));
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
    public function update(Request $request, $id)
    {
        $requestData = $request;

        if($requestData->fromDate<=date('Y-m-d') && date('Y-m-d') <=  $requestData->toDate){
            $validatedData =  $requestData->validate([
                'quotation' => 'required|file|max:150|mimes:xls,pdf,xlsx',
            ]);
        }else{
            return redirect()->back()->with('error','You can upload quotation between start and to date only.');
        }
        
        $details =[];
        
        try{
            $newRequirement = $this->newRequirementRepository->update($id,$requestData);
            
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

            if($newRequirement){
                return redirect()->route('new.requirement.index')->with('success', 'Vendor quotation upload successfully');
            }
            return redirect()->route('new.requirement.index')->with('error','You can upload quotation between start and to date only.');
        }catch(\Exception $ex){
            return redirect()->route('new.requirement.index')->with('error','Something went wrong');
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

}