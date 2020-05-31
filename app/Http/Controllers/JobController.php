<?php

namespace App\Http\Controllers;

use App\Jobs\CartHandler;
use App\Jobs\OrderHandler;
use App\Jobs\PreOrderHandler;
use App\Jobs\ReceiptHandler;

class JobController extends Controller
{
    public function storeOrderJob($order_data)
    {
        dispatch(new OrderHandler($order_data))->delay(now()->addSeconds(1));
    }

    public function sendReceiptJob($recipient_id, $placed_order_data)
    {
        dispatch(new ReceiptHandler($recipient_id, $placed_order_data))->delay(now()->addSeconds(1));
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
