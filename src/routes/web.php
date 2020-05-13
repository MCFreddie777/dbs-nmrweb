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
        Route::middleware('role:admin')->group(function () {
            Route::get('/{id}/edit', 'SampleController@edit');
            Route::put('/{id}', 'SampleController@update');
            Route::delete('/{id}', 'SampleController@destroy');
        });
    });

    Route::prefix('analyses')->group(function () {
        Route::get('/', 'AnalysesController@index');
        Route::middleware('role:laborant,admin')->group(function () {
            Route::get('/new', 'AnalysesController@create');
            Route::post('/', 'AnalysesController@store');
        });
        Route::get('/{id}', 'AnalysesController@show');
    });

    Route::middleware('role:garant,admin')->group(function () {
        Route::prefix('grants')->group(function () {
            Route::get('/', 'GrantsController@index');
            Route::get('/{id}', 'GrantsController@show');
        });
    });

    Route::middleware('role:admin')->group(function () {

        Route::prefix('users')->group(function () {
            Route::get('/', 'UserController@index');
            Route::post('/', 'UserController@store');
            Route::get('/new', 'UserController@create');
            Route::get('/{id}', 'UserController@show');
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
                Route::post('/', 'SolventController@store');
                Route::get('/new', 'SolventController@create');
                Route::get('/{id}', 'SolventController@edit');
                Route::post('/{id}', 'SolventController@update');
                Route::delete('/{id}', 'SolventController@destroy');

            });
            Route::prefix('labs')->group(function () {
                Route::get('/', 'LabController@index');
                Route::post('/', 'LabController@store');
                Route::get('/new', 'LabController@create');
                Route::get('/{id}', 'LabController@edit');
                Route::post('/{id}', 'LabController@update');
                Route::delete('/{id}', 'LabController@destroy');
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

