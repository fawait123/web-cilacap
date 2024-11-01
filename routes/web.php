<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Dashboard/Dashboard'))->name('dashboard');
Route::get('/vote', fn() => Inertia::render('Vote/Vote'))->name('vote');
Route::get('/vote/{subdistrictID}', fn($subdistrictID) => Inertia::render('Vote/Subdistrict', ['subdistrictID' => $subdistrictID]))->name('vote.subdistrict');
Route::get('/vote/{subdistrictID}/{villageID}', fn($subdistrictID, $villageID) => Inertia::render('Vote/Village', ['subdistrictID' => $subdistrictID, 'villageID' => $villageID]))->name('vote.village');
Route::get('/vote/{subdistrictID}/{villageID}/input-vote', fn($subdistrictID, $villageID) => Inertia::render('Vote/InputVote', ['subdistrictID' => $subdistrictID, 'villageID' => $villageID]))->name('vote.input.vote');

// auth
Route::get('/login', fn() => Inertia::render('Auth/Login'))->name('auth.login');
