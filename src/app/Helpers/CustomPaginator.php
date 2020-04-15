<?php


namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomPaginator
{

    public static function validateRequest(Request $request, array $sortKeys)
    {
        $validator = Validator::make($request->all(), [
            'direction' => 'sometimes|in:ASC,DESC',
            'page' => 'sometimes|integer',
            'search' => 'sometimes|string'
        ]);

        $request_sort_key = $request->get('sort');
        if (
            $validator->fails() ||
            (isset($request_sort_key) && !in_array($request_sort_key, $sortKeys))
        ) {
            return false;
        }

        return true;
    }

    public static function makePaginationObject(Request $request, int $limit, $results = null)
    {
        return new Pagination(
            [
                'current_page' => $request->get('page') ?? 1,
                'total_pages' => is_null($results) ? $results : (int)($results / $limit),
                'limit' => $limit,
                'sort' => (object)[
                    'key' => $request->get('sort') ?? 'id',
                    'real_key' => ($request->get('sort') == 'id' || !$request->get('sort')) ? 1 : $request->get('sort'),
                    'direction' => $request->get('direction') ?? 'ASC'
                ],
                'offset' => (($request->get('page') ?? 1) - 1) * $limit
            ]
        );
    }

    public static function validate(Pagination $pagination)
    {
        // In case of page is out of range
        if (
            ($pagination->current_page == 0) ||
            ($pagination->total_pages != 0) && ($pagination->current_page > $pagination->total_pages) ||
            ($pagination->total_pages == 0 && $pagination->current_page > 1)

        )
            abort(404);
    }
}
