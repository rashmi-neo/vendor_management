<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\BankDetailRequest;
use App\Http\Requests\SupportContactRequest;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\VendorRequest;
use App\Model\Vendor;
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

        $userId = Auth::user()->id;
        
        $vendor = Vendor::with('vendorCategory','vendorCategory.category','company')->where('user_id',$userId)->first();
        
        $documents = Document::with('vendorDocument')->get();
        
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
            return redirect()->back()->with('error',$ex->getMessage);
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
            $contactDetail = $this->accountRepository->supportContactSave($request);
            return redirect()->route('accounts.index')->with('success','Contact detail save successfully');
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
            $bankDetail = $this->accountRepository->bankDetailSave($request);
            return redirect()->route('accounts.index')->with('success','Bank details save successfully');
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
        try{
            
            $vendorDetail = $this->accountRepository->updateVendor($id,$requestData);
            if($vendorDetail){
                return redirect()->route('accounts.index')->with('success', 'Vendor Detail is successfully updated');
            }
            return redirect()->route('accounts.index')->with('error','Vendor not found');
        }catch(\Exception $ex){
            return redirect()->route('accounts.index')->with('error','Something went wrong');
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
        
        try{
            $companyDetail = $this->accountRepository->updateCompany($id,$requestData);
            if($companyDetail){
                return redirect()->route('accounts.index')->with('success', 'Company Detail is successfully updated');
            }
            return redirect()->route('accounts.index')->with('error','Company not found');
        }catch(\Exception $ex){
            return redirect()->route('accounts.index')->with('error','Something went wrong');
        }
    }
    
}
