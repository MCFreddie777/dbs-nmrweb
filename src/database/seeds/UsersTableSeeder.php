<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= env('TABLE_COUNT'); $i++) {
            factory(User::class, env('TABLE_COUNT'))->create();
        }
    }
}
