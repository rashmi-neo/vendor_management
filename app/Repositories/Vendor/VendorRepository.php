<?php

namespace App\Repositories\Vendor;
use App\Model\Vendor;
use App\Model\User;
use App\Model\Company;
use App\Model\Category;
use App\Model\VendorCategory;
use App\Model\VendorDocument;
use App\Model\Document;

class VendorRepository implements VendorInterface{

    public $vendor;

    function __construct(Vendor $vendor) {
	$this->vendor = $vendor;
	}

    /**
     * get all categories details.
     *
     * @Author Bharti <bharti.tadvi@neosofttech.com>
     * @param void
     * @return collection
     */
    public function getAllCategories()
    {
        return Category::where('status',1)->get()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name','id');
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

        $user = User::create(['role_id'=>2,'is_verified'=>$data->verify_status,'username'=>$data->first_name,'email'=>$data->email,'password'=>bcrypt('Vendor@123')]);

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
        $vendors = Vendor::with('vendorCategory','vendorCategory.category','company','user','document')->latest()->get();
        
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

        $user = User::where('id','=',$vendor->user_id)->first();
        $user->email = $data->email;
        $user->password = bcrypt($data->password) ;
        $user->save();

        if($data->password){
            
            /* Send email to vendor if password  is update*/
            $details['email'] = $user->email;
            $details['subject']='Vendor login password update';
            $details['firstname'] = $vendor->first_name;
            $details['lastname'] = $vendor->last_name;
            $details['password'] = $data->password;
            $details['from']='Vendor Management System';
            dispatch(new \App\Jobs\SendUpdatePasswordMailToVendor($details));
        }

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

    /**
     * Update vendor status.
     *
     * @Author Bharti <bharti.tadvi@neosofttech.com>
     * @param void
     * @return $user
     */
    public function vendorStatus($data){
        
        $vendor = Vendor::where('id',$data->vendorId)->first();
        $user = User::where('id','=',$vendor->user_id)->first();
        $user->is_verified = $data->status;
        $user->save();

        if($user->is_verified == "approved"){
            
            /* Send email to vendor if verification status is approved*/
            $details['email'] = $user->email;
            $details['subject']='Vendor login verification';
            $details['firstname'] = $vendor->first_name;
            $details['lastname'] = $vendor->last_name;
            $details['password'] = "Vendor@123";
            $details['from']='Vendor Management System';
            dispatch(new \App\Jobs\SendVerificationMailToVendor($details));
        }
        return $user;
    }

    /**
     * Update document status.
     *
     * @Author Bharti <bharti.tadvi@neosofttech.com>
     * @param $data
     * @return $document
     */
    public function documentStatus($data){

        $document = VendorDocument::where('id',$data->documentId)->first();
        $document->status = $data->status;
        $document->save();

        return $document;
    }

    /**
     * Add Document reason.
     *
     * @Author Bharti <bharti.tadvi@neosofttech.com>
     * @param $data
     * @return $document
     */
    public function addReason($data){
        
        $document = VendorDocument::where('id',$data->documentId)->first();
        $document->reason = $data->reason;
        $document->save();

        return $document;
    }


    /**
     * Show Vendor document.
     *
     * @Author Bharti <bharti.tadvi@neosofttech.com>
     * @param $vendorId
     * @return $vendorDocuments
    */
    public function findVendorDocument($vendorId){
        
        $vendorDocuments = Document::with(['vendorDocument' => function ($query) use ($vendorId){
            $query->where('vendor_id', $vendorId);
        }])->get();

        return $vendorDocuments;
    }

}
