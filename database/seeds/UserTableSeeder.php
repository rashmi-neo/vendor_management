<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [   
                'role_id'=>1,
                'username'=>"admin",
                'is_verified'=>"approved",
                'email'=>"admin@gmail.com",
                'password'=>bcrypt("admin123"),
            ],
            
        ];
        User::insert($users);
    }
}
