<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-entry', [EntryController::class, 'createForm'])->name('entry.create.form');
    Route::post('/create-entry', [EntryController::class, 'createPost'])->name('entry.create');
    Route::get('/entry/{id}/pdf', [EntryController::class, 'pdf'])->name('entry.pdf-download');
    Route::get('/entry/{id}', [EntryController::class, 'viewForm'])->name('entry.view');
    Route::post('/entry/{id}', [EntryController::class, 'viewUpdate'])->name('entry.update');
    Route::post('/entry/{id}/delete', [EntryController::class, 'delete'])->name('entry.delete');
});

require __DIR__.'/auth.php';
