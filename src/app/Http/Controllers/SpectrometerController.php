<?php

namespace App\Http\Controllers;

use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\Spectrometer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpectrometerController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['name', 'type']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $spectrometers = Spectrometer::search($search)
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset)
            ->get();

        $rows = Spectrometer::select(DB::raw("count(1) as count"))
            ->search($search)
            ->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('administration.spectrometers.index')
            ->with('spectrometers', $spectrometers)
            ->with('pagination', $pagination);
    }

    public function create()
    {
        return view('administration.spectrometers.new');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $spectrometer = Spectrometer::create($validated);

        if ($spectrometer->id) {
            session()->put(['success' => ['Spektrometer bol vytvorený.']]);
            return redirect('/administration/spectrometers');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa vytvoriť spektrometer']);
        }
    }

    public function edit($id)
    {
        $spectrometer = Spectrometer::findOrFail($id);
        return view('administration.spectrometers.edit')
            ->with('spectrometer', $spectrometer);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules());
        $spectrometer = Spectrometer::findOrFail($id);

        $updated = $spectrometer->update($validated);

        if ($updated) {
            session()->put(['success' => ['Zmeny boli uložené']]);
            return redirect()->back();
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa upraviť spektrometer']);
        }
    }

    public function destroy($id)
    {
        $spectrometer = Spectrometer::findOrFail($id);
        $deleted = $spectrometer->delete();

        if ($deleted) {
            session()->put(['success' => ['Spektrometer bol vymazaný']]);
            return redirect('/administration/spectrometers');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors(['Nepodarilo sa odstrániť spektrometer']);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
        ];
    }
}
