<?php

use App\Grant;
use App\User;
use Illuminate\Database\Seeder;

class GrantsTableSeeder extends Seeder
{
    /**
     * Create grants for user role "garant"
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 3)->get();

        foreach ($users as $user) {
            $user->grants()->save(factory(Grant::class)->make());
        }
    }
}
