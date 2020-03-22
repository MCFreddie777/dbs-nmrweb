<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }
}
