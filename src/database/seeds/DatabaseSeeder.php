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
        // Create fixed statuses
        foreach (array('hotovo', 'rozpracované', 'v poradí') as $status) {
            DB::table('statuses')->insert([
                'name' => $status,
            ]);
        };

        $this->call([
            UsersTableSeeder::class,
            GrantsTableSeeder::class,
            SolventsTableSeeder::class,
            SpectrometersTableSeeder::class,
            LabsTableSeeder::class,
            SamplesTableSeeder::class,
        ]);
    }
}
