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
use App\Http\Controllers\UserController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\ScoreController;
use App\Models\Indicator;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {return redirect('sign-in');});
    Route::get('/home', function () {return redirect('sign-in');});
    Route::get('sign-up', [RegisterController::class, 'create'])->name('register');
    Route::post('sign-up', [RegisterController::class, 'store']);
    Route::get('sign-in', [SessionsController::class, 'create'])->name('login');
    Route::post('sign-in', [SessionsController::class, 'store']);
    Route::post('verify', [SessionsController::class, 'show']);
    Route::post('reset-password', [SessionsController::class, 'update'])->name('password.update');
    Route::get('verify', function () {
        return view('sessions.password.verify');
    })->name('verify');
    Route::get('/reset-password/{token}', function ($token) {
        return view('sessions.password.reset', ['token' => $token]);
    })->name('password.reset');
});

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
// Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
// Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

Route::middleware(['auth','role:admin'])->group(function () {
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

    // Document CRUD routes
    Route::post('document', [DocumentController::class, 'store'])
    ->name('document.store');

    // User CRUD routes
    Route::get('user', [UserController::class, 'index'])
    ->name('user');
    Route::get('/user/search', [userController::class, 'searchUser'])
    ->name('user.search');
    Route::post('user', [userController::class, 'store'])
    ->name('user.store');
    Route::put('user/{user}', [userController::class, 'update'])
    ->name('user.update');
    Route::delete('user/{user}', [userController::class, 'destroy'])
    ->name('user.destroy');

    // OPD CRUD routes
    Route::get('opd', [OpdController::class, 'index'])
    ->name('opd');
    Route::get('/opd/search', [OpdController::class, 'searchOpd'])
    ->name('opd.search');
    Route::post('opd', [OpdController::class, 'store'])
    ->name('opd.store');
    Route::put('opd/{opd}', [OpdController::class, 'update'])
    ->name('opd.update');
    Route::delete('opd/{opd}', [OpdController::class, 'destroy'])
    ->name('opd.destroy');

    // SCORE CRUD ROUTES
    Route::get('score', [ScoreController::class, 'index'])
    ->name('score');
    Route::get('score/{year}', [ScoreController::class, 'indexDetail'])
    ->name('score.show');
    Route::put('score/{indicator}', [ScoreController::class, 'update'])
    ->name('score.update');

    Route::delete('document/{document}', [DocumentController::class, 'destroy'])
    ->name('document.destroy');

    Route::get('create-data', function () {
		return view('pages.create-data');
	})->name('create-data');
});

Route::middleware(['auth','role:user'])->group(function () {
    Route::put('document/{document}', [DocumentController::class, 'update'])
    ->name('document.update');
});

Route::middleware(['auth'])->group(function(){
    Route::get('document', [DocumentController::class, 'index'])
    ->name('document');
    Route::get('document-upload/{indicator}', [DocumentController::class, 'show'])
    ->name('document.upload');
    Route::get('/document/search', [DocumentController::class, 'searchDocument'])
    ->name('document.search');

    Route::get('change-password', [ProfileController::class, 'create'])
    ->name('password.edit');
    Route::put('change-password/{password}', [ProfileController::class, 'update'])
    ->name('password.update');
});
