<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin');
    }

    public function index()
    {
        /*
         *  Because ORM is not allowed in this phase
         *  We need this ugly code right here
         */

        // $users = User::all();

        $query = DB::raw('
            SELECT u.login,r.name FROM users u LEFT JOIN roles r ON u.role_id = r.id;
        ');

        $users = User::fromQuery($query, []);

        $users = $users->map(function ($user) {
            $user->role = new Role();
            $user->role->name = $user->name;
            return $user;
        });

        return view('users.index')->with('users', $users);
    }
}
