<?php

use App\Grant;
use App\Sample;
use Illuminate\Database\Seeder;

class SamplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_count = env('TABLE_COUNT');
        $grant_count = Grant::all()->count();

        for ($i = 1; $i <= env('MAJOR_TABLE_COUNT'); $i++) {
            factory(Sample::class)->create([
                'user_id' => rand(1, $table_count),
                'spectrometer_id' => rand(1, $table_count),
                'solvent_id' => rand(1, $table_count),
                // Not all samples need to be marked as analysed
                // neither belong to grant
                'grant_id' => rand(0, 1) ? rand(1, $grant_count) : NULL,
                'analysis_id' => rand(0, 1) ? rand(1, $table_count) : NULL,
            ]);
        }
    }
}
