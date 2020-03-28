<?php

namespace App\Jobs;

use App\Bot\Common;
use App\Bot\Receipt;
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

    public function __construct($recipient_id, $placed_order_data)
    {
        $this->common = new Common();
        $this->receipt = new Receipt($recipient_id, $placed_order_data);
    }

    public function handle()
    {
        $this->common->sendAPIRequest($this->receipt->sendReceipt());
    }
}
