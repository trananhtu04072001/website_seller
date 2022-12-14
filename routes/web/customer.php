<?php

use App\Http\Controllers\customer\AccountController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\CheckoutController;
use App\Http\Controllers\customer\ProductController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\OrderController;
use App\Http\Livewire\UpdateCart;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {
    Route::get('/layout',[CustomerController::class, 'index'])->name('customer.index');
    Route::get('/home', [ProductController::class, 'eventproduct'])->name('product.event');
    Route::get('/productdetail/{id}',[ProductController::class, 'detail'])->name('cusproduct.detail');
    Route::get('/listproduct/{id}', [ProductController::class, 'listproduct'])->name('product.listcus');
    // Route::get('/typecustomer/{$id}', [ProductController::class, 'typecus'])->name('product.typecus');
    // cart
    Route::get('/cartlist', [UpdateCart::class,'render'])->name('cart.list');
    Route::get('/addcart/{id}', [CartController::class, 'addcart'])->name('cart.add');
    Route::get('/updatecart/{id}',[CartController::class, 'updatecart'])->name('cart.update');
    Route::get('/removecart/{id}', [CartController::class, 'removecart'])->name('cart.remove');
    Route::get('clearcart', [CartController::class, 'clearcart'])->name('cart.clear');
    Route::get('/addcartevent/{id}', [CartController::class, 'addeventcart'])->name('cart.event');
    Route::get('/addcartdetail/{id}', [CartController::class, 'addcartdetail'])->name('cartadd.detail');
    // account
    Route::get('/customregis', [AccountController::class, 'register'])->name('customer.regis');
    Route::post('/customregis', [AccountController::class, 'regisform']);
    Route::get('/cuslogin', [AccountController::class, 'login'])->name('customer.login');
    Route::post('/cuslogin', [AccountController::class, 'loginform']);
    Route::get('/logout', [AccountController::class, 'logout'])->name('customer.logout');
    // checkout
    Route::post('/order', [CheckoutController::class, 'infor'])->name('checkout.infor');
    Route::get('/buypro/{id}', [CheckoutController::class, 'buypro'])->name('checkout.buy');
    Route::get('/infor/{id}', [CheckoutController::class, 'getinform'])->name('checkout.getinform');
    Route::post('/infor/', [CheckoutController::class, 'postinform'])->name('checkout.inform');
    // order
    Route::get('/orderlist/{id}', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orderhis/{id}', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orderdetail/{id}', [OrderController::class, 'detail'])->name('order.detail');
    Route::get('/orderstatus/{id}', [OrderController::class, 'status'])->name('order.status');
    Route::get('/rebuy/{id}', [OrderController::class, 'rebuy'])->name('order.rebuy');
    Route::get('/reorder/{id}', [OrderController::class, 'reorder'])->name('order.reorder');
    Route::get('/reorderpush/{id}', [OrderController::class, 'reorderpush'])->name('reorder.push');
    Route::get('reorderlist/{id}', [OrderController::class, 'listreorder'])->name('order.reorder.list');
    Route::get('reorderstatus/{id}', [OrderController::class, 'reorderstatus'])->name('reorder.status');
    Route::get('/reorderdetail/{id}', [OrderController::class, 'reorderdetail'])->name('reorder.detail');
});
