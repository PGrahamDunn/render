<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VersionNoteController;
use App\Http\Controllers\UserController;

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
/*
Route::get('/', function () {
    return view('dashboard');
});
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Users */

Route::get('/users', function () {
    return view('Users.index');
})->middleware(['auth', 'verified'])->name('users.index');

Route::get('/users/create', function () {
    return view('Users.create');
})->middleware(['auth', 'verified'])->name('users.create');

Route::post('/users', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');

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
