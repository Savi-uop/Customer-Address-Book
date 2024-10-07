<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\LoginController;


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

Route::apiResource('customers', CustomerControllerc::class);
Route::apiResource('projects', ProjectController::class);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('projects', ProjectController::class);
});

// Route for API login
Route::post('/login', [LoginController::class, 'login']);

// // Protect API routes with Passport middleware
// Route::middleware('auth:api')->group(function () {
//     Route::apiResource('customers', CustomerController::class);
//     Route::apiResource('projects', ProjectController::class);
//     // Other protected API routes go here
// });