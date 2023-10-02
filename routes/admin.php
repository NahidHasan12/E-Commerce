<?php

use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\categoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::get('admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');



Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/home', [adminController::class, 'admin'])->name('admin.home');
    Route::get('admin/logout', [adminController::class, 'logout'])->name('admin.logout');

    //Category Route
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/', [categoryController::class, 'index'])->name('index');
        Route::post('/get-data', [categoryController::class, 'getData'])->name('getData');


    });
});
