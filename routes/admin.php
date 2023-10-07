<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\subCategoryController;

Route::get('admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');



Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/home', [adminController::class, 'admin'])->name('admin.home');
    Route::get('admin/logout', [adminController::class, 'logout'])->name('admin.logout');

    //Category Route
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/', [categoryController::class, 'index'])->name('index');
        Route::post('/get-data', [categoryController::class, 'getData'])->name('getData');
        Route::post('/store', [categoryController::class, 'store'])->name('store');
        Route::post('/edit', [categoryController::class, 'edit'])->name('edit');
        Route::post('/update', [categoryController::class, 'update'])->name('update');
        Route::post('/delete', [categoryController::class, 'delete'])->name('delete');
    });

    //Sub Category Route
    Route::prefix('sub_cat')->name('sub_cat.')->group(function(){
        Route::get('/', [subCategoryController::class, 'index'])->name('index');
        Route::post('/get-data', [subCategoryController::class, 'getData'])->name('getData');
        Route::post('/store', [subCategoryController::class, 'store'])->name('store');
        Route::post('/edit', [subCategoryController::class, 'edit'])->name('edit');
        Route::post('/select_cat', [subCategoryController::class, 'selectCategory'])->name('selectCat');
        // Route::post('/update', [categoryController::class, 'update'])->name('update');
        Route::post('/delete', [subCategoryController::class, 'delete'])->name('delete');
    });
});
