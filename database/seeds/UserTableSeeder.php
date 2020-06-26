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
                'id'=>1,
                'role_id'=>1,
                'username'=>"admin",
                'is_verified'=>1,
                'email'=>"admin@gmail.com",
                'password'=>bcrypt("admin123"),
            ],
            
        ];

        User::insert($users);
    }
}
