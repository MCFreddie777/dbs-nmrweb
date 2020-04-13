<?php

namespace App\Http\Controllers;

use App\Solvent;
use Illuminate\Http\Request;

class SolventController extends Controller
{
    public function index()
    {
        $solvents = Solvent::all();
        return view('administration.solvents.index')
            ->with('solvents', $solvents);
    }

    public function create()
    {
        return view('administration.solvents.new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        $solvent = Solvent::create($validated);

        if ($solvent->id) {
            session()->put(['success' => ['Rozpúštadlo bolo vytvorené.']]);
            return redirect('/administration/solvents');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa vytvoriť rozpúštadlo']);
        }
    }

    public function edit($id)
    {
        $solvent = Solvent::findOrFail($id);
        return view('administration.solvents.edit')
            ->with('solvent', $solvent);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);
        $solvent = Solvent::findOrFail($id);

        $updated = $solvent->update($validated);

        if ($updated) {
            session()->put(['success' => ['Zmeny boli uložené']]);
            return redirect()->back();
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa upraviť rozpúštadlo']);
        }
    }

    public function destroy($id)
    {
        $solvent = Solvent::findOrFail($id);
        $deleted = $solvent->delete();

        if ($deleted) {
            session()->put(['success' => ['Rozpúštadlo bolo vymazané']]);
            return redirect('/administration/solvents');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa odstrániť rozpúštadlo']);
        }
    }
}
