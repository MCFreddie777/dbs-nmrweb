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
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        return view('administration.labs.edit')
            ->with('lab', $lab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
