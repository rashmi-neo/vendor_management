<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Model\Company::class, function (Faker $faker) {
    
    return [
        'company_name'=>$faker->company,
        'address'=>$faker->state,
        'state'=>$faker->state,
        'city'=>$faker->city,
        'pincode'=>$faker->numberBetween($min =650000, $max = 850000),
        'contact_number'=>$faker->numberBetween($min =7500000000, $max = 8500000000),
        'fax'=>'2030-43-40',
        'website'=>'www'.'.'.$faker->word.'.'.'com',
    ];
});