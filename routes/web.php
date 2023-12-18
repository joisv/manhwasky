<?php

use App\Http\Controllers\Admin\SeriesController;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Series;
use Illuminate\Http\Request;
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

Route::get('/content/{series:slug}', function(Series $series){
    return view('content',[
        'series' => $series->load(['genres', 'gallery', 'chapters'])
    ]);
})->name('content');

Route::get('read/{series:title}/{chapter:slug}', function(Series $series, Chapter $chapter) {
    return view('chapter', compact(['chapter', 'series']));
})->name('chapter');

Route::get('/genres', function(Request $request) {

    $staticGenre = Genre::withCount('series')
            ->orderByDesc('series_count')
            ->take(10)
            ->get();
    $genre = $request->input('g') ?? $staticGenre[0]->name; 
    
    return view('genres', [
        'genre' => $genre,
        'staticGenre' => $staticGenre
    ]);
    
})->name('home.genres');
Route::view('/populer', 'populer')->name('populer');
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
