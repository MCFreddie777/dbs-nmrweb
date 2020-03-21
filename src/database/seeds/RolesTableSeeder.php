<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (array('laborant', 'garant', 'user') as $rolename) {
            $role = new Role();
            $role->name = $rolename;
            $role->save();
        }
    }
}
