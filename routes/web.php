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

//Route for user login
Route::get("/", "Admin_Panel\DashboardController@showHome")->name('home')->middleware('authenticated.user');
Route::get('/auth/redirect/{provider}', 'Admin_Panel\UserController@redirect');
Route::get('/callback/{provider}', 'Admin_Panel\UserController@callback');
Route::get('logout', 'Admin_Panel\UserController@logout')->name('logout');

//Route for verification
Route::get("bot/verify-web-hook", "Bot\BotController@verifyWebhook")->middleware("verify");
//where Facebook sends messages to. No need to attach the middleware to this because the verification is via GET
Route::post("bot/verify-web-hook", "Bot\BotController@verifyWebhook");

Route::get("bot/{app_id}/test", "Bot\OrderController@getTestData");

Route::group(['prefix' => 'bot/{app_id}'], function () {
    //Routes for place orders
    Route::get("cart/{customer_fb_id}", "Bot\OrderController@viewCheckoutForm")->name("cart.show");
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
});

Route::group(['middleware' => 'unauthenticated.user'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get("dashboard", "Admin_Panel\DashboardController@showDashboard")->name("dashboard");

        //Routes for Products
        Route::group(['prefix' => 'product'], function () {
            Route::get("add-form", "Admin_Panel\ProductController@viewAddProductForm")->name("product.add.view");
            Route::post("store-product", "Admin_Panel\ProductController@storeProduct")->name("product.store");
            Route::get("manage-form", "Admin_Panel\ProductController@viewUpdateProduct")->name("product.manage.view");
            Route::post("update-product", "Admin_Panel\ProductController@updateProduct")->name("product.update");
            Route::get("get-products", "Admin_Panel\ProductController@getProduct")->name("product.get");
        });

        //Routes for Users
        Route::group(['prefix' => 'user'], function () {
            Route::get("add-form", "Admin_Panel\UserController@viewAddUserForm")->name("user.add.view");
            Route::post("store-user", "Admin_Panel\UserController@storeUser")->name("user.store");
            Route::get("manage-form", "Admin_Panel\UserController@viewUpdateUser")->name("user.manage.view");
            Route::get("get-user", "Admin_Panel\UserController@getUser")->name("user.get");
        });

        //Routes for discount
        Route::group(['prefix' => 'discount'], function () {
            Route::get("add-form", "Admin_Panel\DiscountController@viewAddDiscountForm")->name("discount.add.view");
            Route::get("get-product-shop", "Admin_Panel\DiscountController@filterProductByShop")->name("get.shop.product");
            Route::post("store-discount", "Admin_Panel\DiscountController@storeDiscount")->name("discount.store");
            Route::get("manage-form", "Admin_Panel\DiscountController@viewUpdateDiscount")->name("discount.manage.view");
            Route::post("update-discount", "Admin_Panel\DiscountController@updateDiscount")->name("discount.update");
            Route::get("get-discount", "Admin_Panel\DiscountController@getDiscount")->name("discount.get");
        });

        //Routes for order
        Route::group(['prefix' => 'order'], function () {
            Route::get("manage-form", "Admin_Panel\OrderController@viewUpdateOrder")->name("order.manage.view");
            //Route::post("update-discount", "Admin_Panel\DiscountController@updateDiscount")->name("discount.update");
            Route::get("get-order", "Admin_Panel\OrderController@getOrders")->name("order.get");
            Route::get("get-order-details", "Admin_Panel\OrderController@getOrdersDetails")->name("order.details.get");
            Route::get("get-order-status", "Admin_Panel\OrderController@getProductStatus")->name("order.status.get");
            Route::get("get-click", "Admin_Panel\OrderController@realtion");
        });

        //Routes for delivery charges
        Route::group(['prefix' => 'delivery-charge'], function () {
            Route::get("add-form", "Admin_Panel\DeliveryChargeController@viewAddDeliveryChargeForm")->name("dc.add.view");
            Route::post("store-dc", "Admin_Panel\DeliveryChargeController@storeDeliveryCharge")->name('dc.store');
            Route::get("dc-list", "Admin_Panel\DeliveryChargeController@viewDeliveryChargeList")->name('dc.list.view');
            Route::post("update-dc", "Admin_Panel\DeliveryChargeController@updateDeliveryCharge")->name('dc.update');
            Route::get("get-dc", "Admin_Panel\DeliveryChargeController@getDeliveryCharges")->name('dc.get');
        });

        //Routes for shops & billing
        Route::group(['prefix' => 'shop-billing'], function () {
            Route::get("store-page", "Admin_Panel\PageController@storePages")->name('page.store');
            Route::get("shop-list", "Admin_Panel\PageController@viewShopList")->name('shop.list.view');
            Route::get("get-list", "Admin_Panel\PageController@getShopsList")->name('shop.list.get');
        });
    });

});
