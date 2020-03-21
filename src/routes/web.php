<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect('/samples');
});

Route::middleware('auth')->group(function () {
    Route::prefix('samples')->group(function () {
        Route::get('/', 'SamplesController@index');
        Route::get('/new', 'SamplesController@create');
        Route::post('/', 'UsersController@store');
        Route::get('/{id}/edit', 'SamplesController@edit');
        Route::post('/{id}', 'UsersController@update');
    });

    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/{any}', function () {
        return abort(404);
    })->where('any', '.*');
});

