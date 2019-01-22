<?php

use Faker\Generator as Faker;
use App\Models\Movie;

$factory->define(App\Models\Review::class, function (Faker $faker) {
    return [
        
        'movie_id' => function(){

            return Movie::all()->random();
        },
        'name' => $faker->name,
        'remark' => $faker->paragraph(),
        'stars' => $faker->numberBetween(0,5)
    ];
});
