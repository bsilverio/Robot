<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ValidateRegistrationRequest;
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
Route::group(['namespace' => 'UserManagement'], function() {
    Route::post("/login","UserController@login");
    Route::post("/logout","UserController@logout");
});

Route::get("/", function(Request $request) {
    return response()->json([
        'success' => 1,
        'response' => 'Robot API v1.0'
    ]);
});
