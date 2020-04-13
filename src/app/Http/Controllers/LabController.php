<?php

namespace App\Http\Controllers;

use App\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        return view('administration.labs.index')
            ->with('labs', $labs);
    }

    public function create()
    {
        return view('administration.labs.new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $lab = Lab::create($validated);

        if ($lab->id) {
            session()->put(['success' => ['Laboratórium bolo vytvorené.']]);
            return redirect('/administration/labs');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa vytvoriť laboratórium']);
        }
    }

    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        return view('administration.labs.edit')
            ->with('lab', $lab);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules());
        $lab = Lab::findOrFail($id);

        $updated = $lab->update($validated);

        if ($updated) {
            session()->put(['success' => ['Zmeny boli uložené']]);
            return redirect()->back();
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa upraviť laboratórium']);
        }
    }

    public function destroy($id)
    {
        $lab = Lab::findOrFail($id);
        $deleted = $lab->delete();

        if ($deleted) {
            session()->put(['success' => ['Laboratórium bolo vymazané']]);
            return redirect('/administration/labs');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa odstrániť laboratórium']);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:6',
            'address' => 'required|string',
        ];
    }
}
