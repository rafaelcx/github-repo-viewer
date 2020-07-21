<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Repository;
use Faker\Generator as Faker;

$factory->define(Repository::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'full_name' => $faker->name,
        'owner_login' => $faker->userName,
        'html_url' => $faker->url,
        'description' => $faker->paragraph,
        'stargazers_count' => $faker->randomNumber(),
        'language' => $faker->colorName,
    ];
});
