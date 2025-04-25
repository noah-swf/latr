<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchLaterController;
use App\Http\Controllers\FaqController;

use App\Models\WatchLaterVideo;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/home', function (Request $request) {
    $videos = $request->user()->watchLaterVideos()->unwatched()->latest()->simplePaginate(3);

    return view('home', compact('videos'));
})->middleware(['auth', 'verified'])->name('home');


Route::post('/watch-later/store', [WatchLaterController::class, 'store'])->middleware(['auth', 'verified']);
Route::post('/watch-later/toggle-watched/{id}', [WatchLaterController::class, 'toggleWatched'])->middleware(['auth', 'verified'])->name('watch-later.toggle-watched');
Route::delete('/watch-later/{id}', [WatchLaterController::class, 'destroy'])->middleware(['auth', 'verified'])->name('watch-later.destroy');


Route::get('/watched', function (Request $request) {
    $videos = $request->user()->watchedVideos()->latest()->simplePaginate(25);
    return view('watched', compact('videos'));
})->middleware(['auth', 'verified'])->name('watched');


Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/datenschutz', function () {
    return view('datenschutz');
})->name('datenschutz');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
