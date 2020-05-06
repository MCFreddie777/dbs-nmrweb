<?php

namespace App\Http\Controllers;

use App\Grant;
use App\Helpers\CustomPaginator;
use App\Helpers\CustomSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin,garant');
    }

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
            ->take($pagination->limit)->skip($pagination->offset)
            ->get();


        $rows = Grant::select(DB::raw("count(1) as count"))
            ->search($search)
            ->first();

        $pagination->setTotalPages($rows->count);
        CustomPaginator::validate($pagination);

        return view('grants.index')
            ->with('grants', $grants)
            ->with('pagination', $pagination);
    }
}
