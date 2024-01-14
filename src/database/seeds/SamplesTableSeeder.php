<?php

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
        factory(Sample::class, 10)->create(
            [
                'analysis_id' => null // associated samples to analyses are created in AnalysisTableSeeder
            ]
        );
    }
}
