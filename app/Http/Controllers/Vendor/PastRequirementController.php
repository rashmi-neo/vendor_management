<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
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

    public function index(Request $request){
        
        if($request->ajax()){
            $data = $this->pastRequirementRepository->all();
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return view('vendorUser.pastRequirement.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('vendorUser.pastRequirement.index');
    }


    public function show(Request $request,$id){
        
        $pastRequirement = $this->pastRequirementRepository->find($id);
       
        try {
            if($pastRequirement){
    	        return view('vendorUser.pastRequirement.show',compact('pastRequirement'));
            }else{
                return redirect()->route('vendors.index')->with('error', 'Past requirement not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('vendors.index')->with('error', 'Something went wrong!');
        }
    }
}
