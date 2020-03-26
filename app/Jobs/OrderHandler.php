<?php

namespace App\Jobs;

use App\Bot\Common;
use App\Bot\Receipt;
use App\Bot\Template;
use App\Bot\TextMessages;
use App\Customer;
use App\Order;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class OrderHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    private $data;
    private $receipt;
    private $common;
    private $text_message;
    private $template;

    public function __construct($data)
    {
        $this->data = $data;

        $this->receipt = new Receipt($data['customer_fb_id']);
        $this->common = new Common();
        $this->text_message = new TextMessages($data['customer_fb_id']);
        $this->text_message = new TextMessages($data['customer_fb_id']);
        $this->template = new Template($data['customer_fb_id']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->storeOrder($this->data);
    }

    public function storeOrder($data)
    {
        DB::beginTransaction();
        try {
            $customer_details = Customer::where('fb_id', $data['customer_fb_id'])->first();
            $customer_details->first_name = $data['first_name'];
            $customer_details->last_name = $data['last_name'];
            $customer_details->contact = $data['contact'];
            $customer_details->shipping_address = $data['shipping_address'];
            $customer_details->billing_address = $data['billing_address'];
            $customer_details->save();

            $product_codes = $data['product_code'];
            $product_qty = $data['product_qty'];

            for ($i = 0; $i < sizeof($product_codes); $i++) {
                if ($product_codes[$i] != null && $product_qty[$i] != 0) {
                    $product_details = $this->getProductCodeAndPrice($product_codes[$i]);
                    $order = new Order();
                    $order->pid = $product_details->id;
                    $order->customer_id = $customer_details->id;
                    $order->product_qty = $product_qty[$i];
                    $order->subtotal = $product_qty[$i] * $product_details->price;
                    $order->save();
                }
            }

            DB::commit();
            $this->common->sendAPIRequest($this->receipt->sendReceipt());

        } catch (\Exception $e) {
            DB::rollBack();
            $this->common->sendAPIRequest($this->text_message->sendTextMessage("Your order cannot be processed. Please try again!"));
            $this->common->sendAPIRequest($this->template->orderFormTemplate());
        }
    }

    public function getProductCodeAndPrice($product_code)
    {
        return Product::select('id', 'price')->where('code', $product_code)->first();
    }


}
