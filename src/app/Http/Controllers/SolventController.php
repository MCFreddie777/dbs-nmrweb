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
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        $solvent = Solvent::findOrFail($id);
        return view('administration.solvents.edit')
            ->with('solvent', $solvent);
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
