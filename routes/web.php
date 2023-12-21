<?php

use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Models\Chapter;
use App\Models\Series;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/content/{series:slug}', [HomeController::class, 'show'])->name('content');

Route::get('read/{series:title}/{chapter:slug}', [ChapterController::class, 'index'])->name('chapter');

Route::get('/genres', [GenreController::class, 'index'])->name('home.genres');

Route::get('/categories', [CategoryController::class, 'index'])->name('home.categories');

Route::middleware('auth')->get('bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');

Route::view('/populer', 'populer')->name('populer');

Route::middleware('auth')->get('/coins', [CoinsController::class, 'getCoins'])->name('coins');

Route::middleware(['auth', 'role:admin|demo'])->prefix('admin')->group(function () {
    Route::view('dashboard', 'admin/dashboard')
        ->name('dashboard');

    Route::view('series/create', 'admin/series/create')->name('series.create');
    Route::get('series/edit/{series:id}', function(Series $series) {
        return view('admin/series/edit', [
            'series' => $series->load('genres')
        ]);
    })->name('series.edit');
    
    Route::get('series', [SeriesController::class, 'index'])->name('series');

    Route::view('chapters', 'admin/chapters/index')->name('chapters');
    Route::view('genres', 'admin/genres/index')->name('genres');
    Route::view('users', 'admin/users/index')->name('users');
    Route::view('categories', 'admin/categories/index')->name('categories');

    Route::view('sliders', 'admin/sliders/index')->name('sliders');
    Route::view('settings', 'admin/settings')->name('settings');

    Route::view('profile', 'profile')
        ->name('profile');
});


require __DIR__ . '/auth.php';
