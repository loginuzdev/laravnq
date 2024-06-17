<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware("auth:sanctum")->group(function () {
    Route::get("quotes", [\App\Http\Controllers\LandingController::class, "apiGetQuotes"])->name("api.all");
});

Route::get("refresh", [\App\Http\Controllers\LandingController::class, "apiRefreshQuote"])->name("api.refresh");
Route::post("auth", [\App\Http\Controllers\AuthController::class, "authenticate"])->name("api.authenticate");
