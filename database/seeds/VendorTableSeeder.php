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
        /** Create 5 records of Users */
        factory(App\User::class,5)->create()->each(function ($user) {
            // Seed the relation with one Vendor
            $vendor = factory(Vendor::class)->make();
            $user->vendor()->save($vendor);
            
            // Seed the relation with one Company
            $company = factory(Company::class)->make();
            $vendor->company()->save($company);
             
            VendorCategory::create([
                'vendor_id'=>$vendor->id,
                'category_id'=>rand(1,5),
            ]);
        });
    }
}
