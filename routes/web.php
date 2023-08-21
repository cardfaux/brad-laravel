<?php

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

//* User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::post('/register', [UserController::class, 'register'])->middleware('guest')->name('register');
Route::post('/login', [UserController::class, 'login'])->middleware('guest')->name('login.page');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn')->name('logout');

//* Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn')->name('create-post');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn')->name('store-new-post');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost'])->name('view-single-post');
