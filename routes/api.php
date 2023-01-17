<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['origin-cors', 'json'])->group(function() {


    Route::controller(AuthController::class)->group(function() {
        Route::post('register', 'register');
        Route::post('login', 'authenticate');
        // Route::post('logout', 'logout');
    });

    Route::middleware(['jwt-verify'])->group(function() {
        Route::get('get-user', function() {
            return auth()->user();
        });
    });
});
