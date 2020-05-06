<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\User;
use Carbon\CarbonInterval;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin');
    }

    public function index()
    {
        $users = User::all();

        return view('users.index')
            ->with('users', $users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $samples = $user->samples->count();

        $analyses = null;
        $avg_timestamp = 0;
        if ($user->hasRole('laborant')) {
            $analyses = $user->analyses->count();
            if ($analyses) {
                $avg_timestamp = Analysis::selectRaw('ROUND(AVG(TIMESTAMPDIFF(SECOND,created_at,updated_at))) AS timestamp')
                    ->whereUserId($user->id)
                    ->groupBy('user_id')
                    ->first()
                    ->timestamp;
            }
        };

        return view('users.detail')
            ->with('user', $user)
            ->with('samples', $samples)
            ->with('analyses', $analyses)
            ->with('avg_timestamp', CarbonInterval::seconds($avg_timestamp)->cascade()->forHumans());
    }
}
