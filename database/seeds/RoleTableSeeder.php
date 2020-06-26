<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['role_name'=>"admin"],
            ['role_name'=>"vendor"],
        ];

        Role::insert($role);
    }
}
