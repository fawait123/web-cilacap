<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/vote', [VoteController::class, 'subdistrict'])->name('vote');

// auth
Route::get('/login', fn() => Inertia::render('Auth/Login'))->name('auth.login');



Route::get('/import/regionals', [ImportController::class, 'regionals'])->name('import.regionals');
