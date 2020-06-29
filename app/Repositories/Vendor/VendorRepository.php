<?php

namespace App\Repositories\Vendor;
use App\Model\Vendor;
use App\Model\User;
use App\Model\Company;
use Illuminate\Support\Str;


class VendorRepository implements VendorInterface{

    public $vendor;

    function __construct(Vendor $vendor) {
	$this->vendor = $vendor;
	}
    
    /**
     * Save a Vendor details.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param  $data
     * @return $vendorRegister
     */
    public function save($data)
    {
		
        $randomPassword = Str::random(10);
        
        $user = User::create(['role_id'=>2,'is_verified'=>0,'username'=>$data->first_name,
        'email'=>$data->email,'password'=>bcrypt($randomPassword)]);
        
        $vendorObj = new Vendor();
        $vendorObj->user_id = $user->id;
        $vendorObj->first_name = $data->first_name;
        $vendorObj->middle_name = $data->last_name;
        $vendorObj->last_name = $data->middle_name;
        $vendorObj->mobile_number = $data->mobile_number;
        
        if ($image = $data->file('profile_image')) {
            $destinationPath = storage_path('app/public/images');
            if(!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $extension = $image->getClientOriginalExtension();
            $imageName = $image->getClientOriginalName();
            $imageConvertName = md5(uniqid($imageName)).'.'.$extension;
            $image->move($destinationPath, $imageConvertName);
            $vendorObj->profile_image = $imageConvertName;
        }
        
        $vendorObj->save();

        $companyDetail = Company::create(['vendor_id'=>$vendorObj->id,'company_name'=>$data->company_name,
        'address'=>$data->address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode,'contact_number'=>$data->contact_number
        ,'fax'=>$data->fax,'website'=>$data->website]);
        
        return $vendorObj;
    }
}