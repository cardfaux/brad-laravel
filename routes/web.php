<?php

use App\Events\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Follow\FollowController;

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
Route::get('manage-avatar', [UserController::class, 'showAvatarForm'])->middleware('mustBeLoggedIn')->name('manage-avatar');
Route::post('/manage-avatar', [UserController::class, 'storeAvatar'])->middleware('mustBeLoggedIn')->name('store-avatar');

//* Follow related routes
Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow'])->middleware('mustBeLoggedIn')->name('create-follow');
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow'])->middleware('mustBeLoggedIn')->name('remove-follow');

//* Blog post related routes
Route::get('/create-post', [PostController::class, 'showCreateForm'])->middleware('mustBeLoggedIn')->name('create-post');
Route::post('/create-post', [PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn')->name('store-new-post');
Route::get('/post/{post}', [PostController::class, 'viewSinglePost'])->name('view-single-post');
Route::delete('/post/{post}', [PostController::class, 'delete'])->middleware('can:delete,post')->name('delete-post');
Route::get('/post/{post}/edit', [PostController::class, 'showEditForm'])->middleware('can:update,post')->name('edit-post');
Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post')->name('actually-update-post');
Route::get('/search/{term}', [PostController::class, 'search'])->name('search-posts');

//* Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile'])->name('profile');
Route::get('/profile/{user:username}/followers', [UserController::class, 'profileFollowers'])->name('profile-followers');
Route::get('/profile/{user:username}/following', [UserController::class, 'profileFollowing'])->name('profile-following');

//* Raw Profile related routes
Route::group(['prefix' => 'profile', 'middleware' => 'cache.headers:public;max_age=20;etag'], function () {
    Route::get('/{user:username}/raw', [UserController::class, 'profileRaw'])->name('profile-raw');
    Route::get('/{user:username}/followers/raw', [UserController::class, 'profileFollowersRaw'])->name('profile-followers-raw');
    Route::get('/{user:username}/following/raw', [UserController::class, 'profileFollowingRaw'])->name('profile-following-raw');
});
// Route::middleware('cache.headers:public;max_age=20;etag')->group(function () {
//     Route::get('/profile/{user:username}/raw', [UserController::class, 'profileRaw'])->name('profile-raw');
//     Route::get('/profile/{user:username}/followers/raw', [UserController::class, 'profileFollowersRaw'])->name('profile-followers-raw');
//     Route::get('/profile/{user:username}/following/raw', [UserController::class, 'profileFollowingRaw'])->name('profile-following-raw');
// });

// Chat route
Route::post('/send-chat-message', function (Request $request) {
    $formFields = $request->validate([
        'textvalue' => 'required'
    ]);

    if (!trim(strip_tags($formFields['textvalue']))) {
        return response()->noContent();
    }

    broadcast(new ChatMessage(['username' => auth()->user()->username, 'textvalue' => strip_tags($request->textvalue), 'avatar' => auth()->user()->avatar]))->toOthers();
    return response()->noContent();
})->middleware('mustBeLoggedIn')->name('send-chat-message');
