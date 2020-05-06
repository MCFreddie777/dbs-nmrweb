<?php

namespace App\Http\Controllers;

use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\Solvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolventController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['id', 'name']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $solvents = Solvent::search($search)
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset)
            ->get();

        $rows = Solvent::select(DB::raw("count(1) as count"))
            ->search($search)
            ->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('administration.solvents.index')
            ->with('solvents', $solvents)
            ->with('pagination', $pagination);
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
