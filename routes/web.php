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
Route::group(['prefix' => 'bot'], function () {
    //Route for verification
    Route::get("/verify-web-hook", "Bot\BotController@verifyWebhook")->middleware("verify");

    //where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
    Route::post("/verify-web-hook", "Bot\BotController@verifyWebhook");

    //Routes for place orders
    Route::get("cart/{id}", "Bot\OrderController@viewOrderForm")->name("cart.show");
    Route::get("get-cart-products", "Bot\OrderController@getCartProducts")->name("cart.get");
    Route::get("order-store", "Bot\OrderController@storeOrder")->name("order.store");
    Route::get("check-product", "Bot\OrderController@checkProductCode")->name("product.code.check");
    Route::get("check-qty", "Bot\OrderController@checkProductQty")->name("product.qty.check");

    //Routes for track orders
    Route::get("track-order-form/{id}", "Bot\OrderController@viewTrackOrderForm")->name("track.order.form");
    Route::get("get-order-status", "Bot\OrderController@getOrderStatus")->name("order.status.get");

    //Routes for pre orders
    Route::get("pre-order", "Bot\OrderController@storePreOrder")->name("pre-order.store");

    //Routes for add to cart
    Route::get("add-to-cart", "Bot\OrderController@addToCart")->name("add.cart");
    Route::get("remove-cart-product", "Bot\OrderController@removeCartProducts")->name("remove.cart");

    //Route for product enquiry
    Route::get("product-search-form/{id}", "Bot\ProductController@viewProductSearchForm")->name("product.search.form");
    Route::get("get-product", "Bot\ProductController@getProduct")->name("product.get");

    //test route
    Route::get("get-test-data", "OrderController@getTestData")->name('order.details');
});


Route::group(['prefix' => 'admin'], function () {
    //Route::get("add-product", "Admin_Panel\ProductController@addProduct")->name("product.add");
    Route::get("dashboard", "Admin_Panel\DashboardController@showDashboard")->name("dashboard.show");
    Route::get("view-add-product-form", "Admin_Panel\ProductController@viewAddProductForm")->name("product.add.view");
    Route::post("store-product", "Admin_Panel\ProductController@storeProduct")->name("product.store");

    Route::get("view-update-product-page", "Admin_Panel\ProductController@viewUpdateProduct")->name("product.updateDelete");
    Route::get("get-products", "Admin_Panel\ProductController@getProduct")->name("product.get");



    /*add user*/
    Route::get("view-add-user-form", "Admin_Panel\UserController@viewUserForm")->name("user.add.view");
    Route::post("store-user", "Admin_Panel\UserController@storeUser")->name("user.store");

});
