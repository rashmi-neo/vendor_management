<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Model\Vendor;
use App\Model\AssignVendor;
use App\Repositories\PastRequirement\PastRequirementInterface as PastRequirementInterface;


class PastRequirementController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\PastRequirementRepository
    */ 
    private $pastRequirementRepository;

    public function __construct(PastRequirementInterface $pastRequirementRepository){
        $this->pastRequirementRepository = $pastRequirementRepository;
    }

    /**
    * Index page of Past requirement.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    *@param  Illuminate\Http\Request;
    */
    public function index(Request $request){
        
        $categories = $this->findCategory();
        
        $categoryName = [];
        
        if($request->ajax()){
           
            $data = $this->pastRequirementRepository->all();
           
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('priority',function ($row){
                return empty($row->priority)? "-":$row->priority;
            })
            ->editColumn('category_name', function ($row){
                return $row->category->name;
             })
            ->addColumn('action', function($row){
                return view('vendorUser.pastRequirement.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('vendorUser.pastRequirement.index');
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
        $pastRequirement = $this->pastRequirementRepository->find($id);
        $vendorId = Vendor::where('user_id',\Auth::user()->id)->first();
        $assignVendor = AssignVendor::with('requirement')
        ->where('requirement_id',$pastRequirement->id)
        ->whereIn('vendor_id',[$vendorId->id])->first();
        
        try {
            if($pastRequirement){
    	        return view('vendorUser.pastRequirement.show',compact('pastRequirement','category','assignVendor'));
            }else{
                return redirect()->route('past.requirement.index')->with('error', 'Past requirement not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('past.requirement.index')->with('error', 'Something went wrong!');
        }
    }

     /**
    * Get category name of specific vendor.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  void
    * @return $categoryName
    */
    public function findCategory(){
        
        $id =\Auth::user()->id;
        
        $categoryName = Vendor::where('user_id',$id)->where('deleted_at',null)
            ->with('vendorCategory','vendorCategory.category')->first();
        return $categoryName;
    }


    /**
    * Show the form of specified quotation.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $quotations
    */
    public function showQuotationDetail(Request $request,$id){
        
        $quotations = $this->pastRequirementRepository->findQuotation($id);
        
        try {
            if($quotations){
    	        return view('vendorUser.pastRequirement.showQuotation',compact('quotations'));
            }else{
                return redirect()->route('past.requirement.index')->with('error', 'Quotation not found');
            }
        }catch(\Exception $ex){
            return redirect()->route('past.requirement.index')->with('error',json_encode($ex->getMessage()));
        }
    }
}
