<?php

namespace App\Http\Controllers;

use App\Sample;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SampleController extends Controller
{
    public function index()
    {
        $samples = Sample::all();
        return view('samples.index')
            ->with('samples', $samples);
    }
}
