<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\Vendor;
use App\Model\VendorCategory;
use App\Model\Company;


class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $latestUser = User::latest('id')->first();
        
        $user = [
            [   
                'id'=>$latestUser->id+1,
                'role_id'=>2,
                'username'=>"Vendor",
                'is_verified'=>"approved",
                'email'=>"vendor@gmail.com",
                'password'=>bcrypt("vendor@123"),
            ],
            
        ];
        
        $latestVendor = Vendor::latest('id')->first();
        
        $vendor = [
            [   
                'id'=>$latestVendor+1,
                'user_id'=>$latestUser->id+1,
                'first_name'=>"Vendor",
                'middle_name'=>"",
                'last_name'=>"Sharma",
                'mobile_number'=>7544345654,
                'profile_image'=>" ",
            ],
            
        ];
       
        $latestVendorCategory = VendorCategory::latest('id')->first();
        
        $vendorCategory = [
            [   
                'id'=>1,
                'vendor_id'=>$latestVendor+1,
                'category_id'=>3,
            ],
            
        ];

        $latestCompany = Company::latest('id')->first();

        $company = [
            [   
                'id'=>$latestCompany+1,
                'vendor_id'=>$latestVendor+1,
                'company_name'=>"Neosofttech Private LTD",
                'address'=>"Hinjewadi",
                'state'=>"Maharashtra",
                'city'=>'Pune',
                'pincode'=>420118,
                'contact_number'=>02567233432,
                'fax'=>"212-555-1234",
                'website'=>"www.neosofttech.com",
            ],
            
        ];
        
        User::insert($user);
        Vendor::insert($vendor);
        VendorCategory::insert($vendorCategory);
        Company::insert($company);
    }
}
