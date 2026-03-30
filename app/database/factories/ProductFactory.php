<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->image,
        'amount' => $faker->number,
        'description' =>$faker->words,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
