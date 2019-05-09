<?php

use Faker\Generator as Faker;
use App\Task;

$factory->define(App\Step::class, function (Faker $faker) {
    
    return [
        'name'=>$faker->sentence(),
        'completion'=>$faker->boolean(),
        'task_id'=> Task::all()->random()->id
    ];
});
