<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Jobs\Bot\OrderHandler;
use App\Jobs\Bot\CartHandler;
use App\Jobs\Bot\PreOrderHandler;
use App\Jobs\Bot\ReceiptHandler;

class JobController extends Controller
{
    public function storeOrderJob($order_data)
    {
        dispatch(new OrderHandler($order_data))->delay(now()->addSeconds(1));
    }

    public function sendReceiptJob($recipient_id, $placed_order_data, $app_id)
    {
        dispatch(new ReceiptHandler($recipient_id, $placed_order_data, $app_id))->delay(now()->addSeconds(1));
    }

    public function storePreOrderJob($order_data)
    {
        dispatch(new PreOrderHandler($order_data))->delay(now()->addSeconds(1));
    }

    public function addToCartJob($product_data)
    {
        dispatch(new CartHandler($product_data))->delay(now()->addSeconds(1));
    }

}
