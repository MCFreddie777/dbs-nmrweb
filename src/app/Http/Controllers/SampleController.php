<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
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

    public function create()
    {
        $spectrometers = Spectrometer::all();
        $solvents = Solvent::all();
        $grants = Grant::all();

        return view('samples.new')
            ->with('spectrometers', $spectrometers)
            ->with('solvents', $solvents)
            ->with('grants', $grants);
    }
}
