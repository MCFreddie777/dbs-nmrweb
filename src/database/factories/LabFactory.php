<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lab;
use Faker\Generator as Faker;

$factory->define(Lab::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
    return [
        'name' => $faker->stateAbbr . $faker->buildingNumber,
        'address' => $faker->address,
    ];
});
