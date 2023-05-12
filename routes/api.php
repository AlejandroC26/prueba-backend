<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('auth', '\App\Http\Controllers\AuthController@login');

Route::middleware('jwt.verify')->group(function () {
    Route::get('lead/{id}', '\App\Http\Controllers\CandidateController@show');
    Route::get('leads', '\App\Http\Controllers\CandidateController@index');
    Route::post('lead', '\App\Http\Controllers\CandidateController@store')->middleware('auth.agent');
});
