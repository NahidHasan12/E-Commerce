<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ajaxController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

