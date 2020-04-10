<?php

use App\Analysis;
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
        // Create fixed statuses
        foreach (array('hotovo', 'rozpracované', 'v poradí') as $status) {
            DB::table('statuses')->insert([
                'name' => $status,
            ]);
        };

        $table_count = env('TABLE_COUNT');

        for ($i = 1; $i <= $table_count; $i++) {
            factory(Analysis::class)->create([
                'user_id' => rand(1, $table_count),
                'lab_id' => rand(1, $table_count),
                'status_id' => rand(1, 3)
            ]);
        }
    }
}
