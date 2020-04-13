<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Sample;
use App\Solvent;
use App\Spectrometer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SampleController extends Controller
{
    public function index()
    {

        /*
         *  Because ORM is not allowed in this phase
         *  We need this ugly code right here
         */
        // $samples = Sample::all();

        $query = DB::raw('
            SELECT s.id,s.name,u.login,s.created_at FROM samples s LEFT JOIN users u ON s.user_id = u.id;
        ');
        $samples = Sample::fromQuery($query, []);

        $samples = $samples->map(function ($sample) {
            $sample->user = new User();
            $sample->user->login = $sample->login;
            return $sample;
        });

        return view('samples.index')
            ->with('samples', $samples);
    }

    public function create()
    {
//        $spectrometers = Spectrometer::all();
//        $solvents = Solvent::all();
//        $grants = Grant::all();
        $spectrometers = Spectrometer::fromQuery(DB::raw('SELECT * FROM `spectrometers`;'), []);
        $solvents = Solvent::fromQuery(DB::raw('SELECT * FROM `solvents`;'), []);
        $grants = Grant::fromQuery(DB::raw('SELECT * FROM `grants`;'), []);


        return view('samples.new')
            ->with('spectrometers', $spectrometers)
            ->with('solvents', $solvents)
            ->with('grants', $grants);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        /**
         * Sh*t here we go again (without ORM)
         */

        $user = Auth::user();
//        $sample = new Sample($validated);
//       $sample->solvent()->associate(Solvent::find($request->solvent));
//       $sample->spectrometer()->associate(Spectrometer::find($request->spectrometer));
//       $sample->grant()->associate(Grant::find($request->grant));
//       $user->samples()->save($sample);

        $spectrometer = DB::select("SELECT id FROM `spectrometers` WHERE id = :id", ['id' => $request->spectrometer])[0];
        $solvent = DB::select("SELECT id FROM `solvents` WHERE id = :id", ['id' => $request->solvent])[0];
        $grant = NULL;
        if ($request->grant) {
            $grant = DB::select("SELECT id FROM `grants` WHERE id = :id", ['id' => $request->grant])[0];
        }

        $res = DB::insert('
        INSERT INTO samples
        (`name`, `amount`, `structure`, `note`, `solvent_id`, `spectrometer_id`, `grant_id`, `user_id`, `updated_at`, `created_at`)
         values
        (:name, :amount, :structure, :note, :solvent_id, :spectrometer_id, :grant_id, :user_id, :updated_at, :created_at)
        ', [
            'name' => $request->name,
            'amount' => $request->amount,
            'structure' => $request->structure,
            'note' => $request->note,
            'solvent_id' => $solvent->id,
            'spectrometer_id' => $spectrometer->id,
            'grant_id' => $grant ? $grant->id : NULL,
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        /**
         * Oh boi dis was so much pain
         * git reset --hard HEAD^
         */

        if ($res) {
            session()->put(['success' => ['Vzorka bola vytvorená.']]);
            return redirect('/');
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['Nepodarilo sa vytvoriť vzorku']);
    }

    public function show(Request $request)
    {
//        $sample = Sample::findOrFail($request['id']);

        // Ew.
        $sample = DB::select("
                SELECT
                s.id,s.user_id,u.login as user_login,
                s.name,s.amount,s.structure,s.note,s.created_at, s.updated_at,
                sp.name as spectrometer_name , sp.type as spectrometer_type,
                so.name as solvent_name,
                g.name as grant_name,
                s.analysis_id as analysis_id,
                st.name as analysis_status,
                u2.login as analysis_laborant_login
                from samples s
                LEFT JOIN spectrometers sp ON sp.id = s.spectrometer_id
                LEFT JOIN solvents so ON so.id = s.solvent_id
                LEFT JOIN grants g ON g.id = s.grant_id
                LEFT JOIN analyses a ON a.id = s.analysis_id
                LEFT JOIN users u ON u.id = s.user_id
                LEFT JOIN users u2 ON u2.id = a.user_id
                LEFT JOIN statuses st ON st.id = a.status_id
                WHERE s.id = :id",
            ['id' => $request['id']]
        )[0];

        return view('samples.detail')
            ->with('sample', $sample);
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
