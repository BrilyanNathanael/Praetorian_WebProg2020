<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1, 10),
        'name' => $faker->name,
        'price' => $faker->numberBetween(25000, 3000000),
        'stock' => $faker->numberBetween(5, 30),
        'image' => $faker->image('public/storage/images',640,480, null, false),
    ];
});
