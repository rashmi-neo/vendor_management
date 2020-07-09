<?php

namespace App\Repositories\Vendor;
use App\Model\Vendor;
use App\Model\User;
use App\Model\Company;
use App\Model\VendorCategory;
use Illuminate\Support\Str;


class VendorRepository implements VendorInterface{

    public $vendor;

    function __construct(Vendor $vendor) {
	$this->vendor = $vendor;
	}

    /**
     * Save a Vendor details.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param  $data
     * @return $vendorObj
     */
    public function save($data)
    {

        $randomPassword = Str::random(10);

        $user = User::create(['role_id'=>2,'is_verified'=>$data->verify_status,'username'=>$data->first_name,'email'=>$data->email,'password'=>bcrypt($randomPassword)]);

        $vendorObj = new Vendor();
        $vendorObj->user_id = $user->id;
        $vendorObj->first_name = $data->first_name;
        $vendorObj->middle_name = $data->middle_name;
        $vendorObj->last_name = $data->last_name;
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

        $vendorCategory = vendorCategory::create(['vendor_id'=>$vendorObj->id,'category_id'=>$data->category]);

        return $vendorObj;
    }

    /**
     * Get's all vendor.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     *@param  void
     *@return $vendors
     */
    public function all()
    {
        $vendors = Vendor::with('vendorCategory','vendorCategory.category','company','user')->get();
    	return $vendors;
    }

    /**
     * Get's a vendor by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     * @return collection
     */
    public function find($id)
    {
        return Vendor::with('vendorCategory','vendorCategory.category','company')->find($id);
    }

    /**
     * Updates a vendor
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,array $data
     * @return
     */
    public function update($id,$data)
    {

        $vendor = Vendor::with('vendorCategory','vendorCategory.category','company','user')->find($id);

        $vendor->first_name = $data->first_name;
        $vendor->middle_name = $data->middle_name;
        $vendor->last_name = $data->last_name;
        $vendor->mobile_number = $data->mobile_number;
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

        $user = User::where('id','=',$vendor->user_id)->update(['email'=>$data->email,'is_verified'=>$data->verify_status]);

        $company = Company::where('vendor_id','=',$id)->update(['company_name'=>$data->company_name,
        'address'=>$data->address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode,'contact_number'=>$data->contact_number
        ,'fax'=>$data->fax,'website'=>$data->website]);

        $vendorCategory = vendorCategory::where('vendor_id','=',$id)->update(['vendor_id'=>$vendor->id,'category_id'=>$data->category]);

        return $vendor;

    }


}
