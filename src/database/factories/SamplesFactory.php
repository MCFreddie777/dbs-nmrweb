<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Grant;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
use App\User;
use Faker\Generator as Faker;

$factory->define(Sample::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'amount' => $faker->numberBetween(0, 500),
        'structure' => $faker->realText(50),
        'note' => $faker->sentence,

        'spectrometer_id' => function () {
            return factory(Spectrometer::class)->create()->id;
        },
        'solvent_id' => function () {
            return factory(Solvent::class)->create()->id;
        },
        'grant_id' => function () {
            return factory(Grant::class)->create()->id;
        },
    ];
});
