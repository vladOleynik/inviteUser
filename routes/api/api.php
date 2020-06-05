<?php

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

Route::group(['prefix' => config('api.version'), 'namespace' => 'Api'], function () {
    Route::name('auth.')
        ->namespace('Auth')
        ->group(base_path('routes/api/auth.php'));
    Route::middleware('auth:sanctum')
        ->namespace('Invite')
        ->name('invite.')
        ->group(base_path('routes/api/invite.php'));
});
