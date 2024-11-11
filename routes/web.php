<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map-view', [DashboardController::class, 'mapView'])->name('map.view');
Route::get('/vote', [VoteController::class, 'subdistrict'])->name('vote');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

// auth
Route::get('/login', fn() => Inertia::render('Auth/Login'))->name('auth.login');



Route::get('/import/regionals', [ImportController::class, 'regionals'])->name('import.regionals');
