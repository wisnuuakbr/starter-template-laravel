<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Settings;
use App\Http\Controllers\Dashboards\HomeController;
use App\Http\Controllers\Settings\UsersController;
use App\Http\Controllers\Settings\NavigationsController;
use App\Models\Navigation;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

route::get('home', [HomeController::class, 'index'])->name('home');

// Settings
route::get('settings/users', [UsersController::class, 'index'])->name('users');
// Navigations
route::resource('settings/navigations', NavigationsController::class);
route::get('getNavigations', [NavigationsController::class, 'getNavigations'])->name('getNavigations');
