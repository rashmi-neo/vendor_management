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
            $path = 'images';
            $imageData = uploadFile($image,$path);
            $vendorObj->profile_image = $imageData;
        }

        $vendorObj->save();

        $companyDetail = Company::create(['vendor_id'=>$vendorObj->id,'company_name'=>$data->company_name,
        'address'=>$data->address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode,'contact_number'=>$data->contact_number
        ,'fax'=>$data->fax,'website'=>$data->website]);
        
        $categories= $data->category;
        
        foreach($categories as $category ){
            
            $vendorCategory = new vendorCategory();
            $vendorCategory->vendor_id = $vendorObj->id;
            $vendorCategory->category_id = $category;
            $vendorCategory->save();
        }
        
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
        $vendors = Vendor::with('vendorCategory','vendorCategory.category','company','user')->orderBy('id', 'desc')->get();
        
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
            $path = 'images';
            $imageData = uploadFile($image,$path);
            $vendor->profile_image = $imageData;
        }

        $vendor->save();

        $user = User::where('id','=',$vendor->user_id)->update(['email'=>$data->email,'is_verified'=>$data->verify_status]);

        $company = Company::where('vendor_id','=',$id)->update(['company_name'=>$data->company_name,
        'address'=>$data->address,'state'=>$data->state,'city'=>$data->city,'pincode'=>$data->pincode,'contact_number'=>$data->contact_number
        ,'fax'=>$data->fax,'website'=>$data->website]);

        $deleteVendorCategory = VendorCategory::where('vendor_id','=',$id)->delete();        
        
        $categories = $data->category ? $data->category : [];
        
        foreach($categories as $category ){
            $vendorCategory = New VendorCategory();
            $vendorCategory->vendor_id = $id;
            $vendorCategory->category_id = $category;
            $vendorCategory->save();
        }
        
        return $vendor;
    }

}
