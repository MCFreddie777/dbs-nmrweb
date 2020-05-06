<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GrantsController extends Controller
{
    public function index(Request $request)
    {
        if (
            !CustomPaginator::validateRequest($request, ['name', 'samples']) ||
            !CustomSearch::validateRequest($request)
        )
            return redirect()->back();

        $search = $request->get('search') ?? '';
        $pagination = CustomPaginator::makePaginationObject($request, 10);

        $grants = Grant::joinSamplesTable()
            ->select('grants.*', DB::raw("count(1) as samples"))
            ->search($search)
            ->groupBy('grants.id')
            ->orderBy($pagination->sort->real_key, $pagination->sort->direction)
            ->take($pagination->limit)->skip($pagination->offset);

        $rows = Grant::select(DB::raw("count(1) as count"))
            ->search($search);

        // Only admin is allowed to see all records
        if (Gate::denies('admin')) {
            $grants->onlyMine(Auth::id());
            $rows->onlyMine(Auth::id());
        }

        $grants = $grants->get();
        $rows = $rows->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('grants.index')
            ->with('grants', $grants)
            ->with('pagination', $pagination);
    }

    public function show($id)
    {
        $grant = Grant::findOrFail($id);

        return view('grants.detail')
            ->with('grant', $grant);
    }
}
