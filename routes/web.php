<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

use Illuminate\Support\Facades\Http;

use App\Http\Controllers\FighterController;

Route::get('/fighters', [FighterController::class, 'index']);
Route::get('/fighters/{id}', [FighterController::class, 'show'])
    ->where('id', '[A-Za-z0-9\-]+');

Route::get('/', [FighterController::class, 'featured'])->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
