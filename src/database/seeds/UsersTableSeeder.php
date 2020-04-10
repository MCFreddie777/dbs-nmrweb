<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Creates all the users
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

        /**
         * Computing and saving the ultimate and unbreakable password
         */
        $password = Hash::make('nbusr123');

        foreach ($roles as $key => $role) {
            $user = new User();
            $user->login = $key . '@test.sk';
            $user->password = $password;
            $user->role_id = $role->id;
            $user->save();
        }

        for ($i = 1; $i <= env('TABLE_COUNT') - 4; $i++) {
            factory(User::class)->create(['password' => $password]);
        }
    }
}
