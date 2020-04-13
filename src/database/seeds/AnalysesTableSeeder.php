<?php

use App\Analysis;
use App\User;
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

        $laborants = User::where('role_id', 2)->pluck('id')->toArray();

        for ($i = 1; $i <= $table_count; $i++) {
            factory(Analysis::class)->create([
                'user_id' => $laborants[array_rand($laborants, 1)],
                'lab_id' => rand(1, $table_count),
                'status_id' => rand(1, 3)
            ]);
        }
    }
}
