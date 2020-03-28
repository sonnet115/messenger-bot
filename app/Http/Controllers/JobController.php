<?php

namespace App\Http\Controllers;

use App\Jobs\OrderHandler;
use App\Jobs\ReceiptHandler;

class JobController extends Controller
{
    public function storeOrderJob($order_data)
    {
        dispatch(new OrderHandler($order_data))->delay(now()->addSeconds(1));
    }

    public function sendReceiptJob($recipient_id, $placed_order_data)
    {
        dispatch(new ReceiptHandler($recipient_id, $placed_order_data))->delay(now()->addSeconds(5));
    }

}
