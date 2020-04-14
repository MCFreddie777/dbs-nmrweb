<?php


namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomPaginator
{

    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'direction' => 'sometimes|in:ASC,DESC',
            'sort' => 'sometimes|in:login,name,created_at,id',
            'page' => 'sometimes|integer'
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    public static function makePaginationObject(Request $request, int $limit, int $results)
    {
        $pagination = (object)[
            'current_page' => $request->get('page') ?? 1,
            'total_pages' => $results / $limit,
            'limit' => $limit,
            'sort' => (object)[
                'key' => $request->get('sort') ?? 'id',
                'real_key' => ($request->get('sort') == 'id') ? 1 : $request->get('sort'),
                'direction' => $request->get('direction') ?? 'ASC'
            ],
            'offset' => (($request->get('page') ?? 1) - 1) * $limit
        ];

        // In case of page is out of range
        if ($pagination->current_page > $pagination->total_pages)
            abort(404);

        return $pagination;
    }

}
