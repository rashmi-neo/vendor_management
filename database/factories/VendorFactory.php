<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;


$factory->define(App\Model\Vendor::class, function (Faker $faker) {
    
    return [        
        'first_name'=>$faker->firstName,
        'middle_name'=>$faker->name,
        'last_name'=>$faker->lastName,
        'mobile_number'=>$faker->numberBetween($min =7500000000, $max = 8500000000),
        'profile_image'=>$faker->image('public/uploads/images',640,480, null, false),
    ];
});




