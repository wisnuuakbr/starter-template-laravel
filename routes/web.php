<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Settings;
use App\Http\Controllers\Dashboards\HomeController;
use App\Http\Controllers\Settings\UsersController;
use App\Http\Controllers\Settings\NavigationsController;
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
Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', 'Auth\LoginController@login')->name('login.submit'); // Handle form submission

Auth::routes();
// Google O-Auth
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
// Home Route
route::get('home', [HomeController::class, 'index'])->name('home');
// Settings Route
route::get('settings/users', [UsersController::class, 'index'])->name('users');
// Navigations Route
route::resource('settings/navigations', NavigationsController::class);
route::get('getNavigations', [NavigationsController::class, 'getNavigations'])->name('getNavigations');
