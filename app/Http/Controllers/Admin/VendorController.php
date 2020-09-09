<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VendorStoreRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Http\Requests\StoreReasonRequest;
use DataTables;
use App\Model\Document;
use App\Model\Vendor;
use App\User;
use DB;
use App\Repositories\Vendor\VendorInterface as VendorInterface;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;

class VendorController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\Vendor\VendorRepository
    */ 
    private $vendorRepository;
    private $notificationRepository;

    public function __construct(VendorInterface $vendorRepository,NotificationsInterface $notificationRepository){
        $this->vendorRepository = $vendorRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
    * Index page of vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    *@param  Illuminate\Http\Request;
    * @return Datatables
    */
    public function index(Request $request){
        
        $categoryName = [];
        
        if($request->ajax()){
            $data = $this->vendorRepository->all();
        
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('name', function($data){
                return $data->first_name. ' ' .$data->last_name;
            })
            ->addColumn('category', function($data){
                foreach($data->vendorCategory as $category){
                    $categoryName[] = $category->category->name;
                }
                return $categoryName;
            })
            ->addColumn('contact_number', function($data){
                return $data->company->contact_number;
            })
            ->addColumn('company_name', function($data){
                return $data->company->company_name;
            })
            ->addColumn('verification_status', function($data){
                
                $status = \Config::get('constants.VERIFICATION_STATUS');
                
                if($data->user->is_verified == "pending"){
                    
                    return $status['pending'];
                
                }elseif($data->user->is_verified == "approved"){
                    
                    return $status['approved'];
                }
                return $status['rejected'];
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
        $categories = $this->vendorRepository->getAllCategories();
        return view('admin.vendor.create',compact('categories'));
    }
    
    /**
    * Store vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    * 
    *@return void
    */
    public function store(VendorStoreRequest $request){
        
        $requestData = $request;
        
        DB::beginTransaction();
        
        try {
            $result = $this->vendorRepository->save($requestData);
            if($result) {
                DB::commit();
                return redirect()->route('vendors.index')->with('success','Vendor details save successfully');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', json_encode($e->getMessage()));
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
        $categoryId = [];
        
        $categories = $this->vendorRepository->getAllCategories();
        
        $vendor = $this->vendorRepository->find($id);
        
        try {
            if($vendor){
                foreach($vendor->vendorCategory as $category){
                    $categoryId[] = $category->category_id;
                }
    	        return view('admin.vendor.edit',compact('vendor','categories','categoryId'));
            }else{
                return redirect()->route('vendors.index')->with('error', 'Vendor not found');
            }
        }catch(\Exception $e){
            return redirect()->route('vendors.index')->with('error', json_encode($e->getMessage()));
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
        
        DB::beginTransaction();
        
        try{
            $vendor = $this->vendorRepository->update($id,$request);
            if($vendor){
                DB::commit();
                return redirect()->route('vendors.index')->with('success', 'Vendor is successfully updated');
            } else {
                DB::rollback();
                return redirect()->back()->with('error', 'Vendor not found');
            }            
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',json_encode($e->getMessage()));
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
        $vendor = $this->vendorRepository->find($id);
        
        try {
            if($vendor){
                return view('admin.vendor.show',compact('vendor'));
            }else{
                return redirect()->route('vendors.index')->with('error', 'Vendor not found');
            }
        }catch(\Exception $e){
            return redirect()->route('vendors.index')->with('error', json_encode($e->getMessage()));
        }
    }

    /**
    * Update Vendor Status.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return $response
    */
    public function updateVendorStatus(Request $request){
        
        $vendorStatus = $this->vendorRepository->vendorStatus($request);
        
        if (!empty($vendorStatus)) {
            $response = response()->json([
                'success' => true,
                'message' => "Vendor status updated successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Vendor status not updated successfully",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }


    /**
    * Show Document details.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  $id
    *@return $documents
    */
    public function showDocument($id){
        
        if(!empty($id)){
            
            $documents = $this->vendorRepository->findVendorDocument($id);

            if($documents){
                return view('admin.vendor.showDocument',compact('documents'));
            }
        }
    }

    /**
    * Update Document status.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return $response
    */
    public function updateDocumentStatus(Request $request){
        
        $documentStatus = $this->vendorRepository->documentStatus($request);
        
        $vendor = vendor::where('id',$request->vendorId)->first();
                
        $notification = \Config::get('constants.DOCUMENT_STATUS');
        $admin = User::where('id',\Auth::user()->id)->first();
        $userName = ucfirst($admin->username);

        if($admin)
        {
            $notificationDetail = ['user_id'=>$vendor->user_id,'title'=>$notification['title'],'text'=>$userName.' '.$notification['text'],
            'type'=>$notification['type'],'status'=>$notification['status']]; 
            $notification = $this->notificationRepository->save($notificationDetail);
        }

        if (!empty($documentStatus)) {
            $response = response()->json([
                'success' => true,
                'message' => "Document status updated successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Document status not updated successfully",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }

    /**
    * Update Document status.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request
    *@return $response
    */
    public function addDocumentReason(StoreReasonRequest $request){
        
        $addReason = $this->vendorRepository->addReason($request);
        
        $vendor = vendor::where('id',$request->vendorId)->first();
                
        $notification = \Config::get('constants.DOCUMENT_REASON');
        $admin = User::where('id',\Auth::user()->id)->first();
        $userName = ucfirst($admin->username);

        if($admin)
        {
            $notificationDetail = ['user_id'=>$vendor->user_id,'title'=>$notification['title'],'text'=>$userName.' '.$notification['text'],
            'type'=>$notification['type'],'status'=>$notification['status']]; 
            $notification = $this->notificationRepository->save($notificationDetail);
        }

        if (!empty($addReason)) {
            $response = response()->json([
                'success' => true,
                'message' => "Reason added successfully",
            ]);
        
            return $response;
        
        } else {
            $response = response()->json([
                'success' => false,
                'message' => "Reason not added successfully",
                'data' => [
                'status_code' => 401
                ]
            ]);

            return $response;
        }
    }
}
