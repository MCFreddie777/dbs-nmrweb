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
        // Create admin role to rule them all
        $user = new User();
        $role = new Role();
        $role->name = 'admin';
        $role->save();

        // Create the one and only useradmin
        $user->login = 'admin@admin.sk';
        $user->password = Hash::make('Nbusr123');
        $user->role_id = $role->id;
        $user->save();

        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
