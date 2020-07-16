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
use App\Repositories\Account\AccountInterface as AccountInterface;


class AccountController extends Controller
{
    
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\AccountRepository
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
        
        $vendorId =$vendor->id;
        
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
        
        try {
            $vendor = $this->accountRepository->documentSave($request);
            return redirect()->route('accounts.index')->with('success','Document save successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong');
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
        
        try {
            $tab = $request->get('tab');
            $contactDetail = $this->accountRepository->supportContactSave($request);
            return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success','Contact detail save successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong');
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
                
        try {
            $tab = $request->get('tab');
            $bankDetail = $this->accountRepository->bankDetailSave($request);
            return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success','Bank details save successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Something went wrong');
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
       
        // try{
            
            $vendorDetail = $this->accountRepository->updateVendor($id,$requestData);
                    
            if($vendorDetail){
                return redirect()->route('accounts.index')->with('success', 'Vendor Detail is successfully updated');
            }
        //     return redirect()->route('accounts.index')->with('error','Vendor not found');
        // }catch(\Exception $ex){
        //     return redirect()->route('accounts.index')->with('error','Something went wrong');
        // }
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
        
        try{
            $tab = $request->get('tab');
            $companyDetail = $this->accountRepository->updateCompany($id,$requestData);
            if($companyDetail){
                return redirect()->route('accounts.index')->withInput(['tab'=>$tab])->with('success', 'Company Detail is successfully updated');
            }
            return redirect()->route('accounts.index')->with('error','Company not found');
        }catch(\Exception $ex){
            return redirect()->route('accounts.index')->with('error','Something went wrong');
        }
    }
    
}
