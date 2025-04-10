<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchLaterController;

use App\Models\WatchLaterVideo;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    $videos = WatchLaterVideo::with('user')->latest()->simplePaginate(10);
    return view('home', compact('videos'));
})->middleware(['auth', 'verified'])->name('home');

Route::post('/watch-later/store', [WatchLaterController::class, 'store'])->middleware(['auth', 'verified']);



Route::get('/watched', function () {
    return view('watched');
})->middleware(['auth', 'verified'])->name('watched');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
