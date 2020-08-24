<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\BankDetailRequest;
use App\Http\Requests\SupportContactRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\VendorRequest;
use App\Model\Document;
use DB;
use App\Repositories\Account\AccountInterface as AccountInterface;


class AccountController extends Controller
{
    
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\Account\AccountRepository
    */ 
    private $accountRepository;

    public function __construct(AccountInterface $accountRepository){
        $this->accountRepository = $accountRepository;
    }  
    
    /**
    * get all Vendor details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    *
    *@param  Illuminate\Http\Request
    *@return $vendor,$document
    */
    public function index(){
        
        $vendor = $this->accountRepository->findVendor();
        
        $vendorId = $vendor->id;
        
        if(!empty($vendorId)){
            $documents = Document::with(['vendorDocument' => function ($query) use ($vendorId){
                $query->where('vendor_id', $vendorId);
            }])->get();
        }
        
        return view('vendorUser.account.account',compact('vendor','documents'));
    }

    /**
    * Store document details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    *
    *@param  Illuminate\Http\Request
    *@return void
    */
    public function documentStore(DocumentRequest $request){
        
        DB::beginTransaction();

        try {
            $vendor = $this->accountRepository->documentSave($request);
            DB::commit();
            return redirect()->route('accounts.index')->with('success','Document save successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error',json_encode($e->getMessage()));
        }

    }

    /**
    * Store Support contact details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    *
    *@param  Illuminate\Http\\Requests\SupportContactRequest
    *@return void
    */
    public function supportContactStore(SupportContactRequest $request){
        
        DB::beginTransaction();

        try {
            $tab = $request->get('tab');
            $contactDetail = $this->accountRepository->supportContactSave($request);
            DB::commit();
            return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success','Contact detail save successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error',json_encode($e->getMessage()));
        }
    }

     /**
    * Store Bank details.
    *@author Bharti<bharati.tadvi@neosofttech.com> 
    *
    *@param  Illuminate\Http\\Requests\BankDetailRequest
    *@return void
    */
    public function bankDetailStore(BankDetailRequest $request){
        
        DB::beginTransaction();
            
        try {
            $tab = $request->get('tab');
            $bankDetail = $this->accountRepository->bankDetailSave($request);
            DB::commit();
            return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success','Bank details save successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error',json_encode($e->getMessage()));
        }
    }

    
    /**
     * Update the vendor detail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function updateVendorDetail(VendorRequest $request, $id)
    {
        $requestData = $request;
       
        DB::beginTransaction();

        try{
            
            $vendorDetail = $this->accountRepository->updateVendor($id,$requestData);
                    
            if($vendorDetail){
                DB::commit();
                return redirect()->route('accounts.index')->with('success', 'Vendor Detail is successfully updated');
            }
            return redirect()->route('accounts.index')->with('error','Vendor not found');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('accounts.index')->with('error',json_encode($ex->getMessage()));
        }
    }  
    
    /**
     * Update the company detail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function updateCompanyDetail(CompanyRequest $request, $id)
    {
        $requestData = $request;
        
        DB::beginTransaction();
        
        try{
            $tab = $request->get('tab');
            $companyDetail = $this->accountRepository->updateCompany($id,$requestData);
            if($companyDetail){
                DB::commit();
                return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success', 'Company Detail is successfully updated');
            }
            return redirect()->route('accounts.index')->with('error','Company not found');
        }catch(\Exception $ex){
            DB::rollback();
            return redirect()->route('accounts.index')->with('error',json_encode($ex->getMessage()));
        }
    }
    
}
