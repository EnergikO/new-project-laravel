<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', [Api\UserController::class, 'getUsers'])->name('users.index');
Route::get('/users/{id}', [Api\UserController::class, 'getUserById'])->name('users.show');

Route::get('/posts', [Api\PostController::class, 'getPosts'])->name('users.index');
Route::get('/posts/{id}', [Api\PostController::class, 'getPostById'])->name('users.show');
