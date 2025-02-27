<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profileView', function () {
    return view('profile');
})->name('profileView');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [PostsController::class, 'index'])->name('dashboard');

Route::post('/github/update', [ProfileController::class, 'updateGithub'])->name('github.update');
Route::post('/skills/update', [ProfileController::class, 'updateSkills'])->name('skills.update');
Route::post('/languages/update', [ProfileController::class, 'updateLanguages'])->name('languages.update');
Route::resource('posts', PostsController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
