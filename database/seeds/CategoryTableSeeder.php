<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
           [
            'name' => 'Access Control/Security',
            'status' => 1
           ],

           [
           	'name' => 'Banking Services',
            'status' => 1,
           ],
           
           [
           	'name' => 'Computers:Hardware',
            'status' => 1,
           ],

           [
           	'name' => 'Electrical',
            'status' => 1,
           ],

           [
           	'name' => 'Electronics',
            'status' => 1,
           ]
                 
        ];
        foreach ($category as $key => $value) {
			     Category::create($value);
		    }
    }
}
