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
Route::get("/verify-web-hook", "BotController@verifyWebhook")->middleware("verify");

//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("/verify-web-hook", "BotController@verifyWebhook");

//Routes for place orders
Route::get("cart/{id}", "OrderController@viewOrderForm")->name("cart.show");
Route::get("get-cart-products", "OrderController@getCartProducts")->name("cart.get");
Route::get("order-store", "OrderController@storeOrder")->name("order.store");
Route::get("check-product", "OrderController@checkProductCode")->name("product.code.check");
Route::get("check-qty", "OrderController@checkProductQty")->name("product.qty.check");

//Routes for track orders
Route::get("track-order-form/{id}", "OrderController@viewTrackOrderForm")->name("track.order.form");
Route::get("get-order-status", "OrderController@getOrderStatus")->name("order.status.get");

//Routes for pre orders
Route::get("pre-order", "OrderController@storePreOrder")->name("pre-order.store");

//Routes for add to cart
Route::get("add-to-cart", "OrderController@addToCart")->name("add.cart");
Route::get("remove-cart-product", "OrderController@removeCartProducts")->name("remove.cart");

//Route for product enquiry
Route::get("product-search-form/{id}", "ProductController@viewProductSearchForm")->name("product.search.form");
Route::get("get-product", "ProductController@getProduct")->name("product.get");


//test route
Route::get("get-test-data", "OrderController@getTestData")->name('order.details');
