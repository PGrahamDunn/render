<?php

use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RenderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionNoteController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Middleware\Authorize;

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

/* dashboard */ 
/*
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::get('/', [RenderController::class, 'show_home'])->name('home');
Route::get('/preview', [RenderController::class, 'show_preview'])->name('preview');
Route::get('/map', [RenderController::class, 'show_map'])->name('map');
Route::get('/oldmap', [RenderController::class, 'show_old_map'])->name('oldmap');
//Route::get('/dashboard', [RenderController::class, 'show_dashboard'])->name('dashboard');
Route::get('/dashboard', [RenderController::class, 'show_dashboard'])->name('dashboard');
/* Users */

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users.index')->can('admin');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create')->can('admin');
Route::post('/users', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store')->can('admin');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit')->can('admin');
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update')->can('admin');

/* Version */

Route::get('/version', [VersionNoteController::class, 'index'])->name('version');

/* Help */

Route::get('/help', function () {
    return view('help');
})->middleware(['auth', 'verified'])->name('help');

/* authentication */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
