<?php

namespace App\Repositories\Account;
use App\Model\Vendor;
use App\Model\VendorDocument;
use App\Model\SupportContactDetail;
use App\Model\BankDetail;
use App\User;
use App\Model\Company;



class AccountRepository implements AccountInterface{

    public $vendor;

    function __construct(Vendor $vendor) {
	$this->vendor = $vendor;
	}
    
    /**
     * Save a Vendor document.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return 
     */
    public function documentSave($data)
    {
        
        $vendorDocument = New VendorDocument();
        $vendorDocument->vendor_id = $data->vendor_id;
        $vendorDocument->document_id = $data->document_id;
        $vendorDocument->reason = $data->reason;

        if ($docFile = $data->file('file')) {
            
            $destinationPath = storage_path('app/public/uploads');
            if(!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $extension = $docFile->getClientOriginalExtension();
            $documentName = $docFile->getClientOriginalName();
            $documentConvertName = md5(uniqid($documentName)).'.'.$extension;
            $docFile->move($destinationPath, $documentConvertName);
            $vendorDocument->file_name = $documentConvertName;
        }
        
        $vendorDocument->save();
        return $vendorDocument;
    }

    /**
     * Save support contact detail.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return 
     */
    public function supportContactSave($data){
        
        $contactObject = New SupportContactDetail();
        $contactObject->vendor_id = $data->vendor_id;
        $contactObject->contact_person = $data->name;
        $contactObject->phone_number = $data->contact_number;
        $contactObject->email = $data->email_address;
        $contactObject->save();
        
        return $contactObject;
     
    }

    /**
     * Save support contact detail.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return 
     */
    public function bankDetailSave($data){
        $bankDetail = New BankDetail();
        $bankDetail->vendor_id = $data->vendor_id;
        $bankDetail->bank_name = $data->bank_name;
        $bankDetail->account_holder_name = $data->account_holder_name;
        $bankDetail->account_number = $data->account_number;
        $bankDetail->ifsc_code = $data->ifsc_code;
        $bankDetail->save();
    
        return $bankDetail;
    }

    /**
     * Updates a vendor
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return 
     */
    public function updateVendor($id,$data)
    {
        
        $vendor = Vendor::with('vendorCategory','vendorCategory.category','company','user')->find($id);
        
        $vendor->first_name = $data->first_name;
        $vendor->middle_name = $data->middle_name;
        $vendor->last_name = $data->last_name;
        $vendor->mobile_number = $data->phone_number;
        
        if ($image = $data->file('profile_image')) {
            
            $destinationPath = storage_path('app/public/images');
            if(!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();
            $imageConvertName = md5(uniqid($imageName)).'.'.$extension;
            $image->move($destinationPath, $imageConvertName);
            $vendor->profile_image = $imageConvertName;
        }

        $vendor->save();
        
        $user = User::where('id','=',$vendor->user_id)->update(['email'=>$data->email]);
        
        return $vendor;
    }

    /**
     * Updates a Company details
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return 
     */
    public function updateCompany($id,$data)
    {
        
        $company = Company::where('vendor_id',$id)->update(['company_name'=>$data->company_name,
        'address'=>$data->company_address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode]);
        return $company;
    }

}