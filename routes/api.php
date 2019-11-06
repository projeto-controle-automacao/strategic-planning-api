<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('Api')->group(function () {

    Route::post('login', 'Auth\\LoginController@login');
    Route::post('logout', 'Auth\\LoginController@logout');
    Route::post('refresh', 'Auth\\LoginController@refresh');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::name('companies')->group(function () {

            Route::resource('companies/{id}/company-profile', 'CompanyProfileController');

            Route::resource('companies', 'CompanyController');
        });
    });
    Route::get('getbyPillarField/{pillar}/{field}', 'SubFrases_has_Fields@getByPillarAndField');
    Route::get('getByPillar/{pillar}', 'SubFrases_has_Fields@getByPillar');
    Route::name('users')->group(function () {

        Route::resource('users', 'UserController');
    });
});
