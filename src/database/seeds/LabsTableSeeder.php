<?php

use App\Lab;
use Illuminate\Database\Seeder;

class LabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= env('TABLE_COUNT'); $i++) {
            factory(Lab::class)->create();
        }
    }
}
