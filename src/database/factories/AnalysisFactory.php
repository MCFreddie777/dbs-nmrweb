<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Analysis;
use App\Lab;
use App\User;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Analysis::class, function (Faker $faker) {

    return [
        'user_id' => User::whereHas('role', function ($q) {
            $q->where('name', 'laborant');
        })->pluck('id')->random(),
        'lab_id' => Lab::all()->pluck('id')->random(),
        'status_id' => DB::table('statuses')->get()->pluck('id')->random(),
        'updated_at' => Carbon::now()->addRealHours(rand(0, 72))->addRealMinutes(rand(0, 60))
    ];
});
