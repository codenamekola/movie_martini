<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Models\Movie::class, function (Faker $faker) {
    return [
        
        'name' => $faker->word,
        'user_id' => function(){

            return User::all()->random();
        },
        'lead_actor' => $faker->name,
        'description' => $faker->sentence(),
        'genre' => $faker->word
    ];
});
