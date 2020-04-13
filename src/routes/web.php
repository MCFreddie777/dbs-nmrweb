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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::get('/', function () {
    return redirect('/samples');
});

Route::middleware('auth')->group(function () {
    Route::prefix('samples')->group(function () {
        Route::get('/', 'SampleController@index');
        Route::get('/new', 'SampleController@create');
        Route::post('/', 'SampleController@store');
        Route::get('/{id}', 'SampleController@show');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index');
    });

    Route::prefix('files')->group(function () {
        Route::get('/', 'FileController@index');
    });

    Route::prefix('change-password')->group(function () {
        Route::get('/', 'Auth\AuthController@change')->name('pass-change');
        Route::post('/', 'Auth\AuthController@reset');
    });

    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/{any}', function () {
        return abort(404);
    })->where('any', '.*');
});

