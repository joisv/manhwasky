<?php

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

Route::view('/', 'welcome');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::view('dashboard', 'admin/dashboard')
        ->name('dashboard');

    Route::view('series/create', 'admin/series/create')->name('series.create');
    Route::view('series', 'admin/series/index')->name('series');

    Route::view('profile', 'profile')
        ->name('profile');
});


require __DIR__ . '/auth.php';
