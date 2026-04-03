<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->name,
        'image' => 'test.jpg',
        'amount' => $faker->numberBetween(100,10000),
        'description' =>$faker->sentence,
    ];
});