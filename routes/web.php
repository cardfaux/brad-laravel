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
Route::get('/', [UserController::class, 'showCorrectHomepage']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//* Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->name('create-post');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->name('store-new-post');
