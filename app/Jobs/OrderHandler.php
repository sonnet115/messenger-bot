<?php

namespace App\Jobs;

use App\Customer;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
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
            $product_details = $this->getProductCodeAndPrice($product_codes[$i]);
            $order = new Order();
            $order->pid = $product_details->id;
            $order->customer_id = $customer_details->id;
            $order->product_qty = $product_qty[$i];
            $order->subtotal = $product_qty[$i] * $product_details->price;
            $order->save();
        }
    }

    public function getProductCodeAndPrice($product_code)
    {
        return Product::select('id', 'price')->where('code', $product_code)->first();
    }
}
