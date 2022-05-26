<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Ruta para buscar amigo
    Route::get('/search/{nick_name}', [SearchController::class , 'search'])->name('search');
    // Rutas de las publicaciones
    Route::post('/create-post', [PostController::class , 'createPost'])->name('create-post');
    // Listar publicaciones
    Route::get('/list-post', [PostController::class , 'getPosts'])->name('list-post');
    Route::post('/like-post', [PostController::class , 'likeOrDiskLike'])->name('like-post');

    Route::post('/comment', [PostController::class , 'comment'])->name('comment');

    //Profile
    Route::get('/profile/{nick_name}', [ProfileController::class , 'index'])->name('profile');

    //Follow
    Route::post('/follow-user', [ProfileController::class , 'followUser'])->name('follow-user');
    Route::post('/unfollow-user', [ProfileController::class , 'unFollow'])->name('unfollow-user');
    Route::get('/exists-follow/{user_id}', [ProfileController::class , 'existsFollow'])->name('exists-follow');



});
