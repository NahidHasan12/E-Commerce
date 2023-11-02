<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ajaxController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Website\cartController;
use App\Http\Controllers\Website\indexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('frontend/product', function () {
    return view('frontend.pages.product_details');
});

Auth::routes();
Route::get('/', function(){
    return redirect()->to('/');
})->name('login');

// Route::get('/register', function(){
//     return redirect()->to('/');
// })->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');


//======={Practice Ajax}==========//
Route::get('/ajax', function(){
  return view('ajax.ajax');
});
Route::get('ajax/data',[ajaxController::class, 'ajaxRequest'])->name('ajax.request');


//===={Ajax Curd}======//

Route::get('ajax/show', function(){
    return view('ajax.curd.ajax');
  });

Route::post('ajax/store',[ajaxController::class, 'Store'])->name('ajax.store');
Route::post('ajax/get_data',[ajaxController::class, 'getData'])->name('ajax.getData');
Route::post('ajax/edit_data',[ajaxController::class, 'editData'])->name('ajax.editData');
Route::post('ajax/select_board',[ajaxController::class, 'selectBoard'])->name('ajax.selectBoard');
Route::post('ajax/update_data',[ajaxController::class, 'updateData'])->name('ajax.updateData');
Route::post('ajax/delete_data',[ajaxController::class, 'deleteData'])->name('ajax.delete');


// Website Route
Route::get('/', [indexController::class, 'index'])->name('website.index');
Route::prefix('product_details')->name('product.')->group(function(){
    Route::get('/{slug}', [indexController::class, 'product_details'])->name('details');
    // this route for product details page review
    Route::post('/product/review', [indexController::class,'review'])->name('review.store');
});


//WishList Route
Route::get('wishlist/add/{id}',[cartController::class, 'wishlistAdd'])->name('wishlist.add');

//Quick View Route
Route::get('quick_view',[indexController::class, 'quickView'])->name('quick.view');

// Add to card
Route::post('add-to-cart', [cartController::class,'addToCartQv'])->name('add.to.cart.quickview');
Route::get('my_cart',[cartController::class,'myCart'])->name('my.cart');
Route::get('/cart/destroy', function(){
  Cart::destroy();
});
