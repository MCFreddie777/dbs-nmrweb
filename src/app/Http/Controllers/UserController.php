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

        $users = DB::select('
            SELECT
                u.id,
                u.login,
                r.name as role_name,
                IFNULL(samples,0) as samples
            FROM users u
            JOIN roles r on r.id = u.role_id
            LEFT JOIN (
                SELECT user_id, COUNT(1) as samples
                FROM samples
                GROUP BY user_id
            )
            smp ON smp.user_id = u.id
        ');


        return view('users.index')->with('users', $users);
    }

    public function show($id)
    {
        $user = DB::select('
            SELECT
            u.id, u.login,
            r.name as role_name,
            IFNULL(samples,0) as samples,
            IFNULL(analyses,0) as analyses,
            avg_timestamp
            FROM users u
            JOIN roles r on r.id = u.role_id
            LEFT JOIN (
                SELECT
                    user_id,
                    COUNT(1) as samples
                FROM samples
                GROUP BY user_id
            ) smp ON smp.user_id = u.id
            LEFT JOIN (
                SELECT
                    user_id,
                    COUNT(1) as analyses,
                    ROUND(AVG(TIMESTAMPDIFF(SECOND,created_at,updated_at))) as avg_timestamp
                FROM analyses
                GROUP BY user_id
            ) a ON a.user_id = u.id
            WHERE u.id = :id
            ',
            ['id' => $id]
        )[0];

        return view('users.detail')->with('user', $user);
    }
}
