<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Analysis;
use App\Lab;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(Analysis::class, function (Faker $faker) {


    return [
        'user_id' => function () {
            return User::where('role_id', 2)->pluck('id')->random();
        },
        'lab_id' => function () {
            $ids = Lab::all()->pluck('id');

            if ($ids->count() < env('TABLE_COUNT'))
                return factory(Lab::class, 2)->create()[0]->id;
            else
                return $ids->random();
        },
        'status_id' => DB::table('statuses')->get()->pluck('id')->random()
    ];
});
