<?php

use App\Solvent;
use Illuminate\Database\Seeder;

class SolventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= env('TABLE_COUNT'); $i++) {
            factory(Solvent::class)->create();
        }
    }
}
