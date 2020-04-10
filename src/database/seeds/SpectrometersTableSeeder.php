<?php

use App\Spectrometer;
use Illuminate\Database\Seeder;

class SpectrometersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= env('TABLE_COUNT'); $i++) {
            factory(Spectrometer::class)->create();
        }
    }
}
