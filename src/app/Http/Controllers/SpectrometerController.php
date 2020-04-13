<?php

namespace App\Http\Controllers;

use App\Spectrometer;
use Illuminate\Http\Request;

class SpectrometerController extends Controller
{
    public function index()
    {
        $spectrometers = Spectrometer::all();
        return view('administration.spectrometers.index')
            ->with('spectrometers', $spectrometers);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        $spectrometer = Spectrometer::findOrFail($id);
        return view('administration.spectrometers.edit')
            ->with('spectrometer', $spectrometer);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
