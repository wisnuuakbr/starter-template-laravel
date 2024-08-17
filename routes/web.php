<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboards\HomeController;
use App\Http\Controllers\Settings\UsersController;
use App\Http\Controllers\Settings\NavigationsController;
use App\Http\Controllers\Roles\RolesController;

// google login
use App\Http\Controllers\Auth\GoogleLoginController;


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
// Login Route
// Route::get('/', function () {
//     return view('auth.login');
// })->name('login');

// Auth::routes();

// Auth User
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('auth.authenticate');

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('auth.store');

// Google O-Auth
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    // Home Route
    route::get('home', [HomeController::class, 'index'])->name('home');
    // Management Users Route
    route::get('settings/users', [UsersController::class, 'index'])->name('users');
    route::post('settings/users/store', [UsersController::class, 'store'])->name('users.store');
    route::delete('settings/users/delete/{user_id}', [UsersController::class, 'destroy'])->name('users.destroy');
    route::get('settings/users/show/{user_id}', [UsersController::class, 'show'])->name('users.show');
    route::put('settings/users/update/{user_id}', [UsersController::class, 'update'])->name('users.update');
    // Navigations Route
    route::resource('settings/navigations', NavigationsController::class);
    route::get('getNavigations', [NavigationsController::class, 'getNavigations'])->name('getNavigations');

});
