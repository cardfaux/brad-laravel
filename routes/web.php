<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Example\ExampleController;

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

Route::get('/', [ExampleController::class, 'HomePage']);

Route::get('/about', [ExampleController::class, 'AboutPage']);
