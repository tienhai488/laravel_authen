<?php

use App\Http\Controllers\Admin\DashboardController;
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
});