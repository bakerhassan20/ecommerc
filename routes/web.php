<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\website\CartController;


use App\Http\Controllers\website\MyOrderController;
use App\Http\Controllers\website\CheckOutController;
use App\Http\Controllers\website\MangeAccountController;

Auth::routes(['verify'=>true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>'auth'],function(){
    Route::get('/account', [MangeAccountController::class, 'index'])->name('account');
    Route::post('/account/update', [MangeAccountController::class, 'update'])->name('updateAccount');
    Route::post('/account/delete', [MangeAccountController::class, 'destroy'])->name('destroyAccount');
    Route::post('/account/updateimage', [MangeAccountController::class, 'updateimage'])->name('updateimage');


    Route::group(['middleware'=>'empty-cart'],function(){
         /**Route Cart **/
       // Route::get('/cart',[CartController::class,'index'])->name('cart');
        /**End Route Cart */

        /**Route Check out */
        Route::get('/check-out',[CheckOutController::class,'index'])->name('check-out');
        Route::post('/confirm-order',[CheckOutController::class,'store'])->name('confirm-order');
        /***End Route Check out */
    });

     /*** Route my order*/

    Route::get('/my-order', [MyOrderController::class, 'index'])->name('myorder');
    Route::post('/delete-order', [MyOrderController::class, 'destroy'])->name('deleteorder');
    Route::post('/select-date', [MyOrderController::class, 'selectdate'])->name('selectdate');



Route::get('cart', [ProductController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');

Route::get('purchase', [ProductController::class, 'purchase'])->name('purchase')->middleware('auth');
Route::post('checkout', [ProductController::class, 'checkout'])->name('checkout')->middleware('auth');

Route::post('/search', [ProductController::class, 'search'])->name('search');
Route::get('/category/{id}', [ProductController::class, 'getcategory']);
Route::post('/searchcat', [ProductController::class, 'searchcat'])->name('searchcat');
Route::post('/searchsub', [ProductController::class, 'searchsub'])->name('searchsub');

});

