<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserController;

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

//* Admin related routes
Route::get('/admins-only', function () {
    return 'Only admins should be able to see this page.';
})->middleware('can:visitAdminPages');

//* User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest')->name('register');
Route::post('/login', [UserController::class, 'login'])->middleware('guest')->name('login.page');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn')->name('logout');

//* Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn')->name('create-post');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn')->name('store-new-post');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost'])->name('view-single-post');
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post')->name('delete-post');
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post')->name('edit-post');
Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post')->name('actually-update-post');

//* Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile'])->name('profile');
