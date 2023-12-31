<?php

namespace App\Jobs\Bot;

use App\Http\Controllers\Bot\OrderController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CartHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $order_controller;

    public function __construct($data)
    {
        $this->data = $data;
        $this->order_controller = new OrderController();
    }

    public function handle()
    {
        $this->order_controller->processAddToCart($this->data);
    }
}
