<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');

Route::middleware('auth')->group(function() {
    Route::resource('movies', MovieController::class)->except(['show']);
    Route::resource('genres', GenreController::class)->except(['show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        if (auth()->user()->is_admin) {
            return view('admin.dashboard');
        } else {
            abort(403); 
        }
    });
});

require __DIR__.'/auth.php';

Route::resource('movies', MovieController::class);
Route::resource('genres', GenreController::class);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
