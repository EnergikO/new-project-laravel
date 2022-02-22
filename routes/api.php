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


Route::post('/signup', [Api\AuthController::class, 'signup'])->name('signup');
Route::post('/login', [Api\AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts', [Api\PostController::class, 'add'])->name('posts.add');
    Route::post('/logout', [Api\AuthController::class, 'logout'])->name('logout');
});

Route::get('/users', [Api\UserController::class, 'getUsers'])->name('users.index');
Route::get('/users/{id}', [Api\UserController::class, 'getUserById'])->name('users.show');
Route::get('/users/{id}/posts', [Api\PostController::class, 'getPostsByAuthorId'])->name('users.posts');

Route::get('/posts', [Api\PostController::class, 'getPosts'])->name('users.index');
Route::get('/posts/{id}', [Api\PostController::class, 'getPostById'])->name('users.show');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::patch('/posts/{id}', [API\PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [API\PostController::class, 'delete'])->name('posts.delete');
});

Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::delete('/users/{id}', [API\UserController::class, 'delete'])->name('posts.delete');
});
