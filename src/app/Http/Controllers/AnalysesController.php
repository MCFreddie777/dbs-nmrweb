<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Lab;
use App\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalysesController extends Controller
{
    public function index()
    {
        return view('analyses.index');
    }

    public function create(Request $request)
    {
        if (!$request->get('sample')) abort(404);
        $sample = Sample::findOrFail($request->get('sample'));
        $labs = Lab::all();

        return view('analyses.new')
            ->with('sample', $sample)
            ->with('labs', $labs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $sample = Sample::findOrFail($request->get('sample'));
        $lab = Lab::findOrFail($request->get('lab'));

        $analysis = new Analysis();
        $analysis->user()->associate(Auth::user());
        $analysis->status_id = 3;
        $res = $lab->analyses()->save($analysis);
        $sample->analysis()->associate($analysis)->save();

        if ($res) {
            session()->put(['success' => ['Analýza bola začatá.']]);
            return redirect('/analyses/' . $analysis->id);
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa vytvoriť analýzu']);
        }
    }

    public function rules()
    {
        return [
            'sample' => 'required|exists:App\Sample,id',
            'lab' => 'required|exists:App\Lab,id',
        ];
    }
}
