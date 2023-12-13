<?php

use App\Http\Controllers\Admin\SeriesController;
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
Route::view('/', 'welcome')->name('home');

Route::view('/chapter', 'chapter')->name('chapter');
Route::view('/content', 'content')->name('content');

// Route::view('/', 'home/home');

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

    Route::view('sliders', 'admin/sliders/index')->name('sliders');
    Route::view('settings', 'admin/settings')->name('settings');

    Route::view('profile', 'profile')
        ->name('profile');
});


require __DIR__ . '/auth.php';
