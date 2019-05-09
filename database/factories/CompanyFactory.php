<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'city'=>$faker->city,
        'email'=>$faker->email,
        'vision'=>$faker->catchPhrase(),//口号
        'phone'=>$faker->phoneNumber
    ];
});
