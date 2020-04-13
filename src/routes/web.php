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

    Route::prefix('analyses')->group(function () {
        Route::get('/', 'AnalysesController@index');
    });

    Route::middleware('can:admin,garant')->group(function () {
        Route::prefix('grants')->group(function () {
            Route::get('/', 'GrantsController@index');
        });
    });

    Route::middleware('can:admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'UserController@index');
        });
        Route::prefix('administration')->group(function () {

            Route::get('/', function () {
                return view('administration.index');
            });

            Route::prefix('spectrometers')->group(function () {
                Route::get('/', 'SpectrometerController@index');
                Route::post('/', 'SpectrometerController@store');
                Route::get('/new', 'SpectrometerController@create');
                Route::get('/{id}', 'SpectrometerController@edit');
                Route::post('/{id}', 'SpectrometerController@update');
                Route::delete('/{id}', 'SpectrometerController@destroy');
            });
            Route::prefix('solvents')->group(function () {
                Route::get('/', 'SolventController@index');

            });
            Route::prefix('labs')->group(function () {
                Route::get('/', 'LabController@index');
            });
        });
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

