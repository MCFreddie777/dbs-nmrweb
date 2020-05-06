<?php

namespace App\Http\Controllers;

use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['name', 'address']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $labs = Lab::search($search)
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset)
            ->get();

        $rows = Lab::select(DB::raw("count(1) as count"))
            ->search($search)
            ->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('administration.labs.index')
            ->with('labs', $labs)
            ->with('pagination', $pagination);
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
