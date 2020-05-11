<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\Lab;
use App\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AnalysesController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['id', 'sample', 'status']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $analyses = Analysis::joinSamplesTable()
            ->joinStatusesTable()
            ->select('samples.name as sample', 'analyses.*', 'statuses.id as status_id', 'statuses.name as status')
            ->search($search)
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset);

        $rows = Analysis::joinSamplesTable()
            ->select(DB::raw("count(1) as count"))
            ->search($search);

        // Only admin is allowed to see all records
        if (Gate::allows('user')) {
            $analyses->onlyMine(Auth::id());
            $rows->onlyMine(Auth::id());
        }

        // fetch from DB
        $analyses = $analyses->get();
        $rows = $rows->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('analyses.index')
            ->with('analyses', $analyses)
            ->with('pagination', $pagination);
    }

    public function show($id)
    {
        $analysis = Analysis::findOrFail($id);

        if (
            !Gate::allows('admin') &&
            !Gate::allows('laborant') &&
            $analysis->sample->user->id != Auth::id()
        )
            abort(404);

        return view('analyses.detail')
            ->with('analysis', $analysis);
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
