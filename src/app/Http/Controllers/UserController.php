<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use App\User;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin');
    }

    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['login', 'role', 'samples']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 8);

        $users = User::joinRolesTable()
            ->joinSamplesTable()
            ->select('users.*', 'roles.name as role', DB::raw("count(1) as samples"))
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->search($search)
            ->groupBy('users.id')
            ->take($pagination->limit)->skip($pagination->offset)
            ->get();

        $rows = User::joinRolesTable()
            ->select(DB::raw("count(1) as count"))
            ->search($search)
            ->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('users.index')
            ->with('users', $users)
            ->with('pagination', $pagination);
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
