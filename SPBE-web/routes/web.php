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

Route::get('/', function () {
    return view('dashboard.index');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\AspectController;
use App\Models\Indicator;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');

	Route::get('document', [DocumentController::class, 'index'])
    ->name('document');
    Route::get('/document/search', [DocumentController::class, 'searchDocument'])
    ->name('document.search');
    Route::post('document', [DocumentController::class, 'store'])
    ->name('document.store');
    Route::put('document/{document}', [DocumentController::class, 'update'])
    ->name('document.update');
    Route::delete('document/{document}', [DocumentController::class, 'destroy'])
    ->name('document.destroy');

    // Domain CRUD routes
    Route::get('domain', [DomainController::class, 'index'])
    ->name('domain');
    Route::get('/domain/search', [DomainController::class, 'searchDomain'])
    ->name('domain.search');
    Route::post('domain', [DomainController::class, 'store'])
    ->name('domain.store');
    Route::put('domain/{domain}', [DomainController::class, 'update'])
    ->name('domain.update');
    Route::delete('domain/{domain}', [DomainController::class, 'destroy'])
    ->name('domain.destroy');

    // Aspect CRUD routes
    Route::get('aspect', [AspectController::class, 'index'])
    ->name('aspect');
    Route::get('/aspect/search', [AspectController::class, 'searchAspect'])
    ->name('aspect.search');
    Route::post('aspect', [AspectController::class, 'store'])
    ->name('aspect.store');
    Route::put('aspect/{aspect}', [AspectController::class, 'update'])
    ->name('aspect.update');
    Route::delete('aspect/{aspect}', [AspectController::class, 'destroy'])
    ->name('aspect.destroy');

    // Indicator CRUD routes
    Route::get('indicator', [IndicatorController::class, 'index'])
    ->name('indicator');
    Route::get('/indicator/search', [IndicatorController::class, 'searchIndicator'])
    ->name('indicator.search');
    Route::post('indicator', [IndicatorController::class, 'store'])
    ->name('indicator.store');
    Route::put('indicator/{indicator}', [IndicatorController::class, 'update'])
    ->name('indicator.update');
    Route::delete('indicator/{indicator}', [IndicatorController::class, 'destroy'])
    ->name('indicator.destroy');

	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');

	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');

	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');

	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');

	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');

    Route::get('create-data', function () {
		return view('pages.create-data');
	})->name('create-data');
});
