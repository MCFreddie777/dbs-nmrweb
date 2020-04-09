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
        /**
         * Create each type of a role and associate an account
         * e.g admin@test.sk, laborant@test.sk etc.
         */

        $roles = [];

        foreach (array('admin', 'laborant', 'garant', 'user') as $rolename) {
            $role = new Role();
            $role->name = $rolename;
            $role->save();
            $roles += [$role->name => $role];
        }

        foreach ($roles as $key => $role) {
            $user = new User();
            $user->login = $key . '@test.sk';
            $user->password = Hash::make('Nbusr123');
            $user->role_id = $role->id;
            $user->save();
        }

        // Create fixed statuses
        foreach (array('hotovo', 'rozpracované', 'v poradí') as $status) {
            DB::table('statuses')->insert([
                'name' => $status,
            ]);
        };

        $this->call([
            UsersTableSeeder::class,
        ]);
    }
}
