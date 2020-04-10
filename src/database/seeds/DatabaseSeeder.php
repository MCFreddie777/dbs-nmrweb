<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            GrantsTableSeeder::class,
            SolventsTableSeeder::class,
            SpectrometersTableSeeder::class,
            LabsTableSeeder::class,
            AnalysesTableSeeder::class,
            SamplesTableSeeder::class,
        ]);
    }
}
