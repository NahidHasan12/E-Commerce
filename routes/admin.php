<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\brandController;
use App\Http\Controllers\Admin\couponController;
use App\Http\Controllers\Admin\ticketController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\Admin\settingController;
use App\Http\Controllers\Admin\campaingController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\warehouseController;
use App\Http\Controllers\Admin\subCategoryController;
use App\Http\Controllers\Admin\pickup_pointController;
use App\Http\Controllers\Admin\childCategoryController;

Route::get('admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');



Route::middleware(['is_admin','auth'])->group(function () {
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
        Route::post('/select_home', [categoryController::class, 'select_home'])->name('select_home');
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
        Route::post('/store', [brandController::class, 'store'])->name('store');
        Route::post('/edit', [brandController::class, 'edit'])->name('edit');
        Route::post('/select_home', [brandController::class, 'select_home'])->name('select_home');
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
        Route::put('/update/{id}', [settingController::class, 'web_settingUpdate'])->name('update');
    });
    Route::prefix('pages')->name('pages.')->group(function(){
        Route::get('/', [settingController::class, 'pages'])->name('pages');
        Route::post('/fatch_pages', [settingController::class, 'fatch_pages'])->name('fatch_pages');
        Route::post('/store_pages', [settingController::class, 'store_pages'])->name('store_pages');
        Route::post('/edit_pages', [settingController::class, 'edit_pages'])->name('edit_pages');
        Route::post('/select_page_position', [settingController::class, 'select_page_position'])->name('select_page_position');
        Route::post('/update_page', [settingController::class, 'update_page'])->name('update_page');
        Route::post('/delete', [settingController::class, 'pages_delete'])->name('delete');
    });

    //Warehouse Route
    Route::prefix('warehouse')->name('warehouse.')->group(function(){
        Route::get('/', [warehouseController::class, 'index'])->name('index');
        Route::post('/fatch_warehouse', [warehouseController::class, 'fatch_warehouse'])->name('fatch_warehouse');
        Route::post('/store', [warehouseController::class, 'store'])->name('store');
        Route::post('/edit', [warehouseController::class, 'edit'])->name('edit');
        Route::post('/update', [warehouseController::class, 'update'])->name('update');
        Route::post('/delete', [warehouseController::class, 'delete'])->name('delete');
    });

    //Coupon Route
    Route::prefix('coupon')->name('coupon.')->group(function(){
        Route::get('/', [couponController::class, 'index'])->name('index');
        Route::post('/fatch_coupon', [couponController::class, 'fatch_coupon'])->name('fatch_coupon');
        Route::post('/store', [couponController::class, 'store'])->name('store');
        Route::post('/edit', [couponController::class, 'edit'])->name('edit');
        Route::post('/selectType', [couponController::class, 'selectType'])->name('selectType');
        Route::post('/selectStatus', [couponController::class, 'selectStatus'])->name('selectStatus');
        Route::post('/update', [couponController::class, 'update'])->name('update');
        Route::post('/delete', [couponController::class, 'delete'])->name('delete');
    });
    //Coupon Route
    Route::prefix('pickup_point')->name('pickup_point.')->group(function(){
        Route::get('/', [pickup_pointController::class, 'index'])->name('index');
        Route::post('/getData', [pickup_pointController::class, 'getData'])->name('getData');
        Route::post('/store', [pickup_pointController::class, 'store'])->name('store');
        Route::post('/edit', [pickup_pointController::class, 'edit'])->name('edit');
        Route::post('/update', [pickup_pointController::class, 'update'])->name('update');
        Route::post('/delete', [pickup_pointController::class, 'delete'])->name('delete');
    });
    //campaing Route
    Route::prefix('campaing')->name('campaing.')->group(function(){
        Route::get('/', [campaingController::class, 'index'])->name('index');
        Route::post('/getData', [campaingController::class, 'getData'])->name('getData');
        Route::post('/store', [campaingController::class, 'store'])->name('store');
        Route::post('/edit', [campaingController::class, 'edit'])->name('edit');
        Route::post('/select_campaingStatus', [campaingController::class, 'select_campaingStatus'])->name('select_campaingStatus');
        Route::post('/update', [campaingController::class, 'update'])->name('update');
        Route::post('/delete', [campaingController::class, 'delete'])->name('delete');
    });


    //Product Route
    Route::prefix('product')->name('product.')->group(function(){
        Route::get('/', [productController::class, 'index'])->name('index');
        Route::get('/create', [productController::class, 'create'])->name('create');
        Route::post('/getData', [productController::class, 'getData'])->name('getData');
        Route::post('/store', [productController::class, 'store'])->name('store');
        Route::get('product/edit/{id}', [productController::class, 'edit'])->name('edit');
        Route::put('product/update/{id}', [productController::class, 'update'])->name('update');
        Route::post('/delete', [productController::class, 'delete'])->name('delete');
        //Select Child Category
        Route::post('/select_childCat', [productController::class, 'childCatSelect'])->name('select_childCat');
        // Featured switch
        Route::post('featured_active', [productController::class, 'featuredActive'])->name('featured_active');
        Route::post('featured_deactivate', [productController::class, 'featuredDeactivate'])->name('featured_deactivate');
        // Featured switch
        Route::post('todayDeal_active', [productController::class, 'todayDeal_active'])->name('todayDeal_active');
        Route::post('todayDeal_deactivate', [productController::class, 'todayDeal_deactivate'])->name('todayDeal_deactivate');
        // Status switch
        Route::post('status_active', [productController::class, 'status_active'])->name('status_active');
        Route::post('status_deactivate', [productController::class, 'status_deactivate'])->name('status_deactivate');
    });

    // Suport Ticket
    Route::prefix('ticket')->name('admin.ticket.')->group(function(){
        Route::get('/index', [ticketController::class,'index'])->name('index');
        Route::post('/getDate', [ticketController::class,'getTicket'])->name('get_ticket');
        Route::post('/show', [ticketController::class,'showTicket'])->name('show');
    });

});
