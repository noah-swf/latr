<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchLaterController;

use App\Models\WatchLaterVideo;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/home', function () {
    $videos = WatchLaterVideo::with(['user'])->unwatched()->latest()->simplePaginate(3);
    return view('home', compact('videos'));
})->middleware(['auth', 'verified'])->name('home');


Route::post('/watch-later/store', [WatchLaterController::class, 'store'])->middleware(['auth', 'verified']);
Route::post('/watch-later/toggle-watched/{id}', [WatchLaterController::class, 'toggleWatched'])->name('watch-later.toggle-watched');


Route::get('/watched', function () {
    $videos = WatchLaterVideo::with(['user'])->watched()->latest()->simplePaginate(50);
    return view('watched', compact('videos'));
})->middleware(['auth', 'verified'])->name('watched');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
