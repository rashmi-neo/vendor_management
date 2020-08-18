<?php

namespace App\Repositories\Account;
use App\Model\Vendor;
use App\Model\VendorDocument;
use App\Model\SupportContactDetail;
use App\Model\BankDetail;
use App\User;
use Auth;
use Config;
use Illuminate\Support\Facades\Hash;
use App\Model\Company;
use App\Repositories\Notifications\NotificationsInterface as NotificationsInterface;


class AccountRepository implements AccountInterface{

    public $vendor;

    function __construct(Vendor $vendor,NotificationsInterface $notificationRepository) {
        $this->vendor = $vendor;
        $this->notificationRepository = $notificationRepository;
        
    }
    
    /**
     * Find a Login Vendor.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  void
     * @return $vendorUser
     */
    public function findVendor(){
        
        $userId = Auth::user()->id;
        
        $vendorUser = Vendor::with('vendorDocument','vendorDocument.document')->where('user_id',$userId)->first();
       
        return $vendorUser;
    }

    /**
     * Save a Vendor document.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return $vendorDocument
     */
    public function documentSave($data)
    {
        
        $vendorDocument = New VendorDocument();
        $vendorDocument->vendor_id = $data->vendor_id;
        $vendorDocument->document_id = $data->document_id;
        
        if ($document = $data->file('file')) {
            $path = '/';
            $data = uploadFile($document,$path);
            $vendorDocument->file_name = $data;
        }
        
        $vendorDocument->save();
        return $vendorDocument;
    }

    /**
     * Save support contact detail.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return $contactObject
     */
    public function supportContactSave($data)
    {
        
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
     * @return $bankDetail
     */
    public function bankDetailSave($data)
    {
        
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
     * @return $user
     */
    public function updateVendor($id,$data)
    {
        
        $vendor = Vendor::with('vendorCategory','vendorCategory.category','company','user')->find($id);
        
        $user = User::where('id','=',$vendor->user_id)->first();
        
        if($vendor->mobile_number != $data->phone_number || $user->email != $data->email){
            
            //send notification to admin
            $admin = User::where(['role_id'=>1])->first();
            
            $notification = Config::get('constants.VENDOR_UPDATE');
            
            if($admin)
            {
                $notificationDetail = ['user_id'=>$admin->id,'title'=>$notification['title'],'text'=>$data->first_name.' '.$data->last_name.' '.$notification['text'],
                'type'=>$notification['type'],'status'=>$notification['status']]; 
                $notification = $this->notificationRepository->save($notificationDetail);
            }
        }
        
        $vendor->first_name = $data->first_name;
        $vendor->middle_name = $data->middle_name;
        $vendor->last_name = $data->last_name;
        $vendor->mobile_number = $data->phone_number;
        
        if ($image = $data->file('profile_image')) {
            $path = 'images';
            $imageData = uploadFile($image,$path);
            $vendor->profile_image = $imageData;
        }

        $vendor->save();
       
        $user = User::where('id','=',$vendor->user_id)->update(['email'=>$data->email,'password'=>Hash::make($data->new_password)]);

        return $user;
    }

    /**
     * Updates a Company details
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return $company
     */
    public function updateCompany($id,$data)
    {
        
        $company = Company::where('vendor_id',$id)->update(['company_name'=>$data->company_name,
        'address'=>$data->company_address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode]);
        return $company;
    }

}