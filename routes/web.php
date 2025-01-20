<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IngredientListController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Posts
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
});
Route::controller(PostController::class)->group(function(){
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/posts/{post}', 'show')->name('posts.show');
    Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
    Route::put('/posts/{post}', 'update')->name('posts.update');
    Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');

});


// Profile
Route::middleware(['auth'])->prefix('profile')->name('user.')->controller(UserController::class)->group(function () {
    Route::get('/', 'showProfile')->name('profile');
    Route::get('/edit', 'editProfile')->name('edit');
    Route::post('/update', 'updateProfile')->name('update');
    Route::get('/{id}', 'showUserInfo')->where('id', '[0-9]+')->name('info.show');
    Route::get('/{id}/edit', 'editUserInfo')->where('id', '[0-9]+')->name('info.edit');
    Route::put('/{id}/update', 'updateUserInfo')->where('id', '[0-9]+')->name('info.update');
    Route::post('/change-password', 'changePassword')->name('password.change');
    Route::post('/delete-account', 'deleteAccount')->name('account.delete');
});

Route::resource('ingredientlists', IngredientListController::class);
Route::resource('ingredients', IngredientController::class);

