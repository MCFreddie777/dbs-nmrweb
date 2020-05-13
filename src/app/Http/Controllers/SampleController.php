<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class SampleController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['login', 'name', 'created_at', 'id']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $samples = Sample::joinUsersTable()
            ->select('users.login', 'samples.*')
            ->search($search)
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset);

        // total number of records (pagination e.g. [1 of 10])
        $rows = Sample::joinUsersTable()
            ->select(DB::raw("count(1) as count"))
            ->search($search);

        // Only admin is allowed to see all records
        if (Gate::allows('user')) {
            $samples->onlyMine(Auth::id());
            $rows->onlyMine(Auth::id());
        }

        // grant search
        $validator = Validator::make($request->all(), [
            'grant' => 'sometimes|numeric'
        ]);

        if ($validator->fails())
            return redirect()->back();

        if (!!$request->get('grant')) {
            $samples = $samples->whereGrantId($request->get('grant'));
            $rows = $rows->whereGrantId($request->get('grant'));
        }

        // fetch from DB
        $samples = $samples->get();
        $rows = $rows->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('samples.index')
            ->with('samples', $samples)
            ->with('pagination', $pagination);
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

    public
    function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $user = Auth::user();
        $sample = new Sample($validated);
        $sample->solvent()->associate(Solvent::find($request->solvent));
        $sample->spectrometer()->associate(Spectrometer::find($request->spectrometer));

        if ($request->grant) {
            $sample->grant()->associate(Grant::find($request->grant));
        }

        $res = $user->samples()->save($sample);

        if ($res) {
            session()->put(['success' => ['Vzorka bola vytvorená.']]);
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['Nepodarilo sa vytvoriť vzorku']);
    }

    public function show($id)
    {
        $sample = Sample::findOrFail($id);
        return view('samples.detail')
            ->with('sample', $sample);
    }

    public function destroy($id)
    {
        $sample = Sample::findOrFail($id);
        $result = $sample->delete();

        if ($result) {
            session()->put(['success' => ['Vzorka bola úspešne vymazaná.']]);
            return redirect('/');
        }
        return redirect()->back()
            ->withErrors(['Nepodarilo sa vymazať vzorku']);
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'amount' => 'required|integer',
            'structure' => 'required|string',
            'spectrometer' => 'required|integer|exists:spectrometers,id',
            'solvent' => 'required|integer|exists:solvents,id',
            'grant' => 'integer|exists:grants,id',
            'note' => 'nullable|string'
        ];
    }
}
