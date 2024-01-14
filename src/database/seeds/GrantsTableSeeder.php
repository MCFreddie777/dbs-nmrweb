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
        $garants = User::whereHas('role', function($q){
            $q->where('name', 'garant');
        })->get();

        foreach ($garants as $garant) {
            if (rand(0, 1)) {
                $garant->grants()->save(factory(Grant::class)->make());
            }
        }
    }
}
