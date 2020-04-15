<?php


namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomSearch
{
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'sometimes|string'
        ]);

        return !$validator->fails();
    }
}
