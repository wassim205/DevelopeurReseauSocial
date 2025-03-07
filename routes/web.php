<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;








Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('test');
// });
// Route::get('/comment', [PostsController::class, 'comment']);

// Route::view('pusher1', 'pusher1');
// Route::view('pusher2', 'pusher2');

Route::get('/profileView', function () {
    return view('profile');
})->name('profileView');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::put('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');


Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::post('/connections/add/{receiverId}', [ConnectionController::class, 'add'])->name('connections.add');
Route::patch('/connections/accept/{connectionId}', [ConnectionController::class, 'accept'])->name('connections.accept');
Route::delete('/connections/decline/{connectionId}', [ConnectionController::class, 'decline'])->name('connections.decline');
Route::delete('/connections/remove/{connectionId}', [ConnectionController::class, 'remove'])->name('connections.remove');


// Routes pour les likes
// Route::post('/posts/{post}/like', [PostsController::class, 'toggleLike'])->name('posts.like');

// Routes pour les commentaires
// Route::post('/posts/{post}/comment', [PostsController::class, 'storeComment'])->name('posts.comment');

Route::middleware('api')->group(function () {
    Route::post('/posts/{post}/like', [PostsController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comments', [PostsController::class, 'storeComment'])->name('posts.comment');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PostsController::class, 'index'])->name('dashboard');
    Route::post('/github/update', [ProfileController::class, 'updateGithub'])->name('github.update');
    Route::post('/skills/update', [ProfileController::class, 'updateSkills'])->name('skills.update');
    Route::post('/languages/update', [ProfileController::class, 'updateLanguages'])->name('languages.update');
    Route::post('/projects/update', [ProfileController::class, 'updateProjects'])->name('projects.update');
    Route::get('/project/edit/{index}', [ProfileController::class, 'projectEdit'])->name('project.edit');
    Route::put('/project/update/{index}', [ProfileController::class, 'projectUpdate'])->name('project.update');
    Route::delete('/project/delete/{index}', [ProfileController::class, 'deleteProject'])->name('project.delete');

    Route::resource('posts', PostsController::class);
});

require __DIR__ . '/auth.php';
