<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function viewOrderForm(Request $request)
    {
        $customer_id = $request->segment(2);
        $get_customer_info = Customer::where('fb_id', $customer_id)->first();
        return view("orders.order_form")->with("customer_info", $get_customer_info);
    }

    public function storeOrder(Request $request)
    {
        $customer_details = Customer::where('fb_id', $request->customer_fb_id)->first();

        $customer_details->first_name = $request->first_name;
        $customer_details->last_name = $request->last_name;
        $customer_details->contact = $request->mobile_number;
        $customer_details->shipping_address = $request->shipping_address;
        $customer_details->billing_address = $request->billing_address;
        $customer_details->save();

        $product_codes = $request->product_code;
        $product_qty = $request->product_qty;


        for ($i = 0; $i < sizeof($product_codes); $i++) {
            $product_details = $this->getProductCodeAndPrice($product_codes[$i]);

            $order = new Order();
            $order->pid = $product_details->id;
            $order->customer_id = $customer_details->id;
            $order->product_qty = $product_qty[$i];
            $order->subtotal = $product_qty[$i] * $product_details->price;
            $order->save();
        }

        return response()->json("Order Placed Successfully. You will get receipt shortly.");
    }

    public function getProductCodeAndPrice($product_code)
    {
        return Product::select('id', 'price')->where('code', $product_code)->first();
    }
}
