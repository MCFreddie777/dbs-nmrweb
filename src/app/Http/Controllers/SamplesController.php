<?php

namespace App\Http\Controllers;

use App\Sample;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SamplesController extends Controller
{
    public function index()
    {
        return view('samples.index');
//            ->with('samples', Sample::all());
    }
}
