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
        factory(Spectrometer::class, 3)->create();
    }
}
