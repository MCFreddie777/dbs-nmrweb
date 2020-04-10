<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Analysis;
use App\Grant;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
use Faker\Generator as Faker;

$factory->define(Sample::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'amount' => $faker->numberBetween(0, 500),
        'structure' => "C/2=F/C=P\C([C+]1#[O+2][Br+]NCOO1)=C2",
        'note' => $faker->sentence,

        'analysis_id' => function () {
            $ids = Analysis::all()->pluck('id');

            // Might or might not be analysed
            if (rand(0, 1) && $ids->count() < env('TABLE_COUNT'))
                return factory(Analysis::class)->create()->id;
            else
                return NULL;
        },

        'spectrometer_id' => function () {
            $ids = Spectrometer::all()->pluck('id');

            if ($ids->count() < env('TABLE_COUNT'))
                return factory(Spectrometer::class)->create()->id;
            else
                return $ids->random();
        },

        'solvent_id' => function () {
            $ids = Solvent::all()->pluck('id');

            if ($ids->count() < env('TABLE_COUNT'))
                return factory(Solvent::class)->create()->id;
            else
                return $ids->random();
        },

        'grant_id' => function () {
            $ids = Grant::all()->pluck('id');

            if ($ids->count() < env('TABLE_COUNT'))
                return factory(Grant::class)->create()->id;
            else if (rand(0, 1))
                return $ids->random();
            return NULL;
        },
    ];
});
