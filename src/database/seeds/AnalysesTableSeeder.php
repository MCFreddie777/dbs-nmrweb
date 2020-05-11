<?php

use App\Analysis;
use App\User;
use Carbon\Carbon;
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
        $table_count = env('TABLE_COUNT');

        for ($i = 1; $i <= $table_count; $i++) {
            factory(Analysis::class)->create([
                'lab_id' => rand(1, $table_count),
                'status_id' => rand(1, 3),
                'updated_at' => Carbon::now()->addRealHours(rand(0, 72))->addRealMinutes(rand(0, 60))
            ]);
        }
    }
}
