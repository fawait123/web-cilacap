<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map-view', [DashboardController::class, 'mapView'])->name('map.view');
Route::get('/vote', [VoteController::class, 'subdistrict'])->name('vote');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

// auth
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('login.action');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/import/regionals', [ImportController::class, 'regionals'])->name('import.regionals');

Route::group(['middleware' => 'auth'], function () {
    // team
    Route::resource('team', TeamController::class);
});
