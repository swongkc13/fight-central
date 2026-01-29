<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use Illuminate\Support\Facades\Http;

use App\Http\Controllers\FighterController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\DivisionController;

Route::get('/fighters', [FighterController::class, 'index']);
Route::get('/fighters/{id}', [FighterController::class, 'show'])
    ->where('id', '[A-Za-z0-9\-]+');

Route::get('/', [FighterController::class, 'featured'])->name('home');

// Rankings
Route::get('/rankings', [RankingController::class, 'index'])->name('rankings.index');

// Show individual ranking categories
Route::get('/rankings/{id}', [RankingController::class, 'show'])
    ->where('id', '[A-Za-z0-9\-]+')
    ->name('rankings.show');

// Divisions
Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
Route::get('/division/{id}', [DivisionController::class, 'show'])->where('id', '[A-Za-z0-9\-]+');

require __DIR__ . '/settings.php';
