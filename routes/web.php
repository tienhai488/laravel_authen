<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register'=>false,
]);

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('index');

    // posts 
    Route::prefix('posts')->name('posts.')->group(function(){
        Route::get('/',[PostsController::class,'index'])->name('index');
        
        Route::get('/add',[PostsController::class,'add'])->name('add');
    });

    // users 
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/',[UsersController::class,'index'])->name('index');
        
        Route::get('/add',[UsersController::class,'add'])->name('add');
    });

    // groups 
    Route::prefix('groups')->name('groups.')->group(function(){
        Route::get('/',[GroupsController::class,'index'])->name('index');
        
        Route::get('/add',[GroupsController::class,'add'])->name('add');
    });

});