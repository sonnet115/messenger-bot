<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//route for verification
Route::get("/test-bot", "BotController@receive")->middleware("verify");

//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("/test-bot", "BotController@receive");

Route::get("order-form/{id}", "OrderController@viewOrderForm")->name("order.form");
Route::get("store-order", "OrderController@storeOrder")->name("order.store");
Route::get("check-product", "OrderController@checkProductCode")->name("product.code.check");
Route::get("check-qty", "OrderController@checkProductQty")->name("product.qty.check");

Route::get("orders-details", "OrderController@getOrders");

