<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin,garant');
    }

    public function index()
    {
        return view('grants.index');
    }
}
