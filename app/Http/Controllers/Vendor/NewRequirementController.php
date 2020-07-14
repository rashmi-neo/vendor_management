<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Response;
use App\Model\Vendor;
use App\Http\Requests\VendorQuotationRequest;
use App\Repositories\NewRequirement\NewRequirementInterface as NewRequirementInterface;

class NewRequirementController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\NewRequirementRepository
    */ 
    private $newRequirementRepository;

    public function __construct(NewRequirementInterface $newRequirementRepository){
        $this->newRequirementRepository = $newRequirementRepository;
    }

    /**
    * Index page of New requirement.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    *@param  Illuminate\Http\Request;
    */
    public function index(Request $request){
        
        $category = $this->findCategory();
        
        if($request->ajax()){
           
            $data = $this->newRequirementRepository->all();
           
            return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('category_name', function($data) use ($category){
                    return $category->vendorCategory->category->name;
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(VendorQuotationRequest $request, $id)
    {
        $requestData = $request;
        dd($request->quotation);
        try{
            $newRequirement = $this->newRequirementRepository->update($id,$requestData);
            if($newRequirement){
                return redirect()->route('new.requirement.index')->with('success', 'Vendor quotation save successfully');
            }
            return redirect()->route('new.requirement.index')->with('error','Requirement not found');
        }catch(\Exception $ex){
            return redirect()->route('new.requirement.index')->with('error','Something went wrong');
        }
    }

    public function getDocumentDownload($filename){
        
        $file = public_path(). "/uploads/uploads/".$filename;
        
        $headers = array(
            'Content-Type: application/pdf',
        );
        
        $newFileName = 'proposal-document'.time();

        return response()->download($file,$newFileName,$headers);

    }

}
