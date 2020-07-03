<?php

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = [
            [   
                'id'=>1,
                'role_id'=>1,
                'username'=>"admin",
                'is_verified'=>1,
                'email'=>"admin@gmail.com",
                'password'=>bcrypt("admin123"),
            ],
            
        ];
        Vendor::create($vendor);
    }
}
