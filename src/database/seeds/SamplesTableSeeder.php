<?php

use App\Analysis;
use App\Grant;
use App\Sample;
use App\User;
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
        $laborants = User::where('role_id', 2)->pluck('id')->toArray();

        for ($i = 1; $i <= env('MAJOR_TABLE_COUNT'); $i++) {
            factory(Sample::class)->create([
                'user_id' => rand(1, $table_count),
                'spectrometer_id' => rand(1, $table_count),
                'solvent_id' => rand(1, $table_count),
                // Not all samples need to be marked as analysed
                // neither belong to grant
                'grant_id' => rand(0, 1) ? rand(1, $grant_count) : NULL,
                'analysis_id' => rand(0, 1) ? function () use ($laborants) {
                    return factory(Analysis::class)->create([
                        'user_id' => $laborants[array_rand($laborants, 1)]
                    ])->id;
                } : NULL,
            ]);
        }
    }
}
