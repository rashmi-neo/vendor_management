<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use App\Model\Vendor;
use App\Model\VendorCategory;
use App\Model\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //$users = factory(App\User::class, 3)->create();

        for ($i=0; $i < 5; $i++) { 
	        $user = User::create([
                'role_id'=>2,
                'username' => Str::random(10),
                'is_verified'=>"approved",
	            'email' => Str::random(10).'@gmail.com',
	            'password' => Hash::make('vendor@123'),
            ]);
            
            $vendor = Vendor::create([
                'user_id'=>$user->id,
                'first_name'=>Str::random(8),
                'middle_name'=>Str::random(8),
                'last_name'=>Str::random(8),
                'mobile_number'=>7544345654,
                'profile_image'=>" ",
            ]);

            VendorCategory::create([
                'vendor_id'=>$vendor->id,
                'category_id'=>3,
            ]);

            Company::create([
                'vendor_id'=>$vendor->id,
                'company_name'=>Str::random(10).' ' .'Private LTD',
                'address'=>"Hinjewadi",
                'state'=>"Maharashtra",
                'city'=>'Pune',
                'pincode'=>443322,
                'contact_number'=>7544345654,
                'fax'=>'2030-43-40',
                'website'=>'www'.Str::random(8).'com',
            ]);
        }
    }
}
