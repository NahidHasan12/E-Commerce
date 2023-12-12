<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ajaxController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Controllers\Website\cartController;
use App\Http\Controllers\Website\checkoutController;
use App\Http\Controllers\Website\customer_reviewController;
use App\Http\Controllers\Website\indexController;
use App\Http\Controllers\Website\profileController;
use App\Http\Controllers\Website\ticketController;

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
    return redirect()->route('admin.login');
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
    // this route for product review
    Route::post('/product/review', [indexController::class,'review'])->name('review.store');
});



//Quick View Route
Route::get('quick_view',[indexController::class, 'quickView'])->name('quick.view');

// Add to card
Route::post('add-to-cart', [cartController::class,'addToCartQv'])->name('add.to.cart.quickview');
Route::get('my_cart',[cartController::class,'myCart'])->name('my.cart');
Route::post('cart-qty/update', [cartController::class,'cartUpdateQty'])->name('cart.qty.update');
Route::post('cart-color/update', [CartController::class,'cartUpdateColor'])->name('cart.color.update');
Route::post('cart-size/update', [CartController::class,'cartUpdateSize'])->name('cart.size.update');

Route::post('cart/reload', [cartController::class,'cartReload'])->name('cart.reload');
Route::get('/cart/destroy',[cartController::class,'cartDestroy'])->name('cart.destroy');
Route::post('cart/remove', [cartController::class,'cartRemove'])->name('cart.remove');

// Checkout
Route::get('checkout', [checkoutController::class,'checkout'])->name('checkout');
Route::post('apply/coupon', [checkoutController::class,'apply_coupon'])->name('apply.coupon');
Route::get('remove/coupon', [checkoutController::class,'remove_coupon'])->name('remove.coupon');
Route::post('order/place', [checkoutController::class,'order_place'])->name('order.place');
// Aamarpay Payment Gateway
Route::post('success',[checkoutController::class,'success'])->name('success');
Route::post('fail',[checkoutController::class,'fail'])->name('fail');
Route::get('cancel',[checkoutController::class,'cancel'])->name('cancel');

//WishList Route
Route::get('wishlist', [cartController::class,'wishlist'])->name('wishlist');
Route::get('wishlist/add/{id}',[cartController::class, 'wishlistAdd'])->name('wishlist.add');
Route::get('wishlist/remove/{id}',[cartController::class, 'wishlistProduct_remove'])->name('wishlist.product.remove');
Route::get('empty/wishlist',[cartController::class, 'empty_wishlist'])->name('wishlist.empty');


// Category Wise Product show
Route::get('categorywise/product/{id}',[indexController::class, 'categoryWise_product'])->name('category_wise.product');
Route::get('subcategorywise/product/{id}',[indexController::class, 'subCategoryWise_product'])->name('subCategory_wise.product');
Route::get('childcategorywise/product/{id}',[indexController::class, 'childCategoryWise_product'])->name('childCategory_wise.product');
Route::get('brandwise/product/{id}',[indexController::class, 'brandWise_product'])->name('brand_wise.product');

//======= Page Manageent from admin===========//
//-------pages show on website---------//
Route::get('pages/{page_slug}',[indexController::class,'viwe_pages'])->name('view.pages');

// Review for website
Route::get('write/review',[customer_reviewController::class,'write_review'])->name('write.review');
Route::post('website/review/store',[customer_reviewController::class,'website_review_store'])->name('website.review.sotre');

// store Newsletter from website home page
Route::post('store/newsletter',[indexController::class,'store_newsletter'])->name('store.newsletter');

// Customer / User Admin Route
Route::post('profile/shipping/store/{shipping_id}', [profileController::class,'profile_shipping_store'])->name('shipping.store');
Route::post('customer/password/update', [profileController::class,'customer_pass_change'])->name('customer.password.change');
//user profile pages
Route::get('customer/dashboard',[profileController::class, 'customer'])->name('customer.dashboard');
Route::get('profile/setting', [profileController::class,'profile_setting'])->name('profile.setting');
Route::get('my/order', [profileController::class,'my_order'])->name('my.order');
Route::get('view/order/{id}', [profileController::class,'view_order'])->name('view.order');

// Order Tracking
Route::get('order/tracking', [indexController::class,'order_tracking'])->name('order.tracking');
Route::post('check/order', [indexController::class,'check_order'])->name('check.order');


//Suport Ticket
Route::get('open/ticket', [ticketController::class,'open_ticket'])->name('open.ticket');
Route::get('new/ticket', [ticketController::class,'new_ticket'])->name('new.ticket');
Route::post('store/ticket', [ticketController::class,'store_ticket'])->name('store.ticket');
Route::get('show/ticket/{id}', [ticketController::class,'show_ticket'])->name('show.ticket');
Route::post('store/ticket/reply', [ticketController::class,'storeReply'])->name('store.ticket.reply');
