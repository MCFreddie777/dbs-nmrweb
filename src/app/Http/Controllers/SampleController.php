<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


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

    public function store(Request $request)
    {
        // TODO (fgic): [HOTFIX]: Previous URL somehow gets to /webfonts/ folder. =(
        session()->setPreviousUrl('/samples/new');

        $validated = $request->validate($this->rules());

        $user = Auth::user();
        $sample = new Sample($validated);

        $sample->solvent()->associate(Solvent::find($request->solvent));
        $sample->spectrometer()->associate(Spectrometer::find($request->spectrometer));
        $sample->grant()->associate(Grant::find($request->grant));
        $user->samples()->save($sample);

        session()->put(['success' => ['Vzorka bola vytvorená.']]);
        return redirect('/');
    }

    public function rules()
    {
        $this->redirect = url()->previous();

        return [
            'name' => 'required|string',
            'amount' => 'required|integer',
            'structure' => 'required|string',
            'spectrometer' => 'required|integer|exists:spectrometers,id',
            'solvent' => 'required|integer|exists:solvents,id',
            'grant' => 'integer|exists:grants,id',
            'note' => 'string'
        ];
    }
}
