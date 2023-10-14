<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\brandController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\childCategoryController;
use App\Http\Controllers\Admin\settingController;
use App\Http\Controllers\Admin\subCategoryController;

Route::get('admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');



Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/home', [adminController::class, 'admin'])->name('admin.home');
    Route::get('admin/logout', [adminController::class, 'logout'])->name('admin.logout');
    Route::get('admin/pass/change', [adminController::class, 'passwordChange'])->name('admin.password.change');
    Route::post('admin/pass/update', [adminController::class, 'passwordUpdate'])->name('admin.password.update');

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
        Route::post('/update', [subCategoryController::class, 'update'])->name('update');
        Route::post('/delete', [subCategoryController::class, 'delete'])->name('delete');
    });

    //Child Category Route
    Route::prefix('child_cat')->name('child_cat.')->group(function(){
        Route::get('/', [childCategoryController::class, 'index'])->name('index');
        //Route::post('/get-data', [childCategoryController::class, 'getData'])->name('getData');
        Route::post('/fatch-data', [childCategoryController::class, 'fatchData'])->name('fatchData');
        Route::post('/store', [childCategoryController::class, 'store'])->name('store');
        Route::post('/edit', [childCategoryController::class, 'edit'])->name('edit');
        Route::post('/update', [childCategoryController::class, 'update'])->name('update');
        Route::post('/delete', [childCategoryController::class, 'delete'])->name('delete');

    });
    //Category wise sub Category Selet Route
    Route::get('sub_cat/{cat_id}',[childCategoryController::class, 'getSubCat'])->name('getSubCat');

    Route::prefix('brand')->name('brand.')->group(function(){
        Route::get('/', [brandController::class, 'index'])->name('index');
        //Route::post('/get-data', [brandController::class, 'getData'])->name('getData');
        // Route::post('/fatch-data', [childCategoryController::class, 'fatchData'])->name('fatchData');
        Route::post('/store', [brandController::class, 'store'])->name('store');
        Route::post('/edit', [brandController::class, 'edit'])->name('edit');
        Route::post('/update', [brandController::class, 'update'])->name('update');
        Route::post('/delete', [brandController::class, 'delete'])->name('delete');
        Route::post('/fatch', [brandController::class, 'fatch'])->name('fatch');
    });

    //Settings Route
    Route::prefix('seo')->name('seo.')->group(function(){
        Route::get('/', [settingController::class, 'seo'])->name('seo');
        Route::put('/update/{id}', [settingController::class, 'seoUpdate'])->name('update');
    });
    Route::prefix('smtp')->name('smtp.')->group(function(){
        Route::get('/', [settingController::class, 'smtp'])->name('smtp');
        Route::put('/update/{id}', [settingController::class, 'smtpUpdate'])->name('update');
    });
    Route::prefix('web_setting')->name('web_setting.')->group(function(){
        Route::get('/', [settingController::class, 'web_setting'])->name('web_setting');
    });
});
