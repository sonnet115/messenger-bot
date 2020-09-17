<?php

namespace App\Jobs\Bot;

use App\Bot\Common;
use App\Bot\Receipt;
use App\Bot\TextMessages;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReceiptHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $receipt;
    private $common;
    private $text_message;
    private $order_data;

    public function __construct($recipient_id, $placed_order_data, $page_token)
    {
        $this->order_data = $placed_order_data;
        $this->common = new Common($page_token);
        $this->receipt = new Receipt($recipient_id, $placed_order_data);
        $this->text_message = new TextMessages($recipient_id);
    }

    public function handle()
    {
        $order_number = "Your order code is '" . $this->order_data->code . "'. Use this code to track your order";
        $this->common->sendAPIRequest($this->receipt->sendReceipt());
        $this->common->sendAPIRequest($this->text_message->sendTextMessage($order_number));
    }
}
