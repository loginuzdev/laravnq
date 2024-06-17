<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/**
 * Disable annoying package
 */

Route::get("_ignition/health-check", function () {
    return response()->json([
        "can_execute_commands"=>false
    ]);
});
Route::post("_ignition/execute-solution", function () {
    return response()->json([
        "message"=>"do I know you?"
    ]);
});
Route::post("_ignition/update-config", function () {
    return response()->json([
        "message"=>"I wasn't born with enough middle fingers!"
    ]);
});

/**
 * Real app Route
 */
Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::middleware('auth')->group(function () {
    // Protected routes
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name("dashboard");
});

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
