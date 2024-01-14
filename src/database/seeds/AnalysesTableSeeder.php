<?php

use App\Analysis;
use App\Sample;
use Illuminate\Database\Seeder;

class AnalysesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Analysis::class, 10)->create()->each(function ($analysis) {
            factory(Sample::class)->create(['analysis_id' => $analysis->id]);
        });
    }
}
