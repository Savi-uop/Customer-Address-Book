<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Redirect to the customers index page by default
Route::get('/', function () {
    return redirect()->route('customers.index'); 
});

// Customer Routes
Route::resource('customers', CustomerController::class);

// Project Routes
Route::resource('projects', ProjectController::class);

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');