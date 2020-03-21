<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Spectrometer;
use Faker\Generator as Faker;

$factory->define(Spectrometer::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
    return [
        'name' => $faker->stateAbbr . " " . $faker->buildingNumber,
        'type' => ucfirst($faker->word) . " " . $faker->buildingNumber,
    ];
});
