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

//Route for verification
Route::get("/test-bot", "BotController@receive")->middleware("verify");

//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("/test-bot", "BotController@receive");

//Routes for place orders
Route::get("order-form/{id}", "OrderController@viewOrderForm")->name("order.form");
Route::get("order-store", "OrderController@storeOrder")->name("order.store");
Route::get("check-product", "OrderController@checkProductCode")->name("product.code.check");
Route::get("check-qty", "OrderController@checkProductQty")->name("product.qty.check");

//Route for product enquiry
Route::get("product-search-form", "ProductController@viewProductSearchForm")->name("product.search.form");
Route::get("get-product", "ProductController@getProduct")->name("product.get");


//test route
Route::get("get-test-data", "OrderController@getTestData")->name('order.details');
