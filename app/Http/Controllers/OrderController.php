<?php

namespace App\Http\Controllers;

use App\Bot\Common;
use App\Bot\Template;
use App\Bot\TextMessages;
use App\Customer;
use App\Order;
use App\PreOrder;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $common;
    private $text_message;
    private $template;
    private $job_controller;

    public function __construct()
    {
        $this->common = new Common();
        $this->job_controller = new JobController();
    }

    public function viewOrderForm(Request $request)
    {
        $customer_id = $request->segment(2);
        $get_customer_info = Customer::where('fb_id', $customer_id)->first();
        return view("orders.order_form")->with("customer_info", $get_customer_info);
    }

    public function storeOrder(Request $request)
    {
        $this->job_controller->storeOrderJob($request->all());
        return response()->json("Order Placed Successfully. You will get receipt shortly.");
    }

    public function processOrder($data)
    {
        $this->text_message = new TextMessages($data['customer_fb_id']);
        $this->template = new Template($data['customer_fb_id']);

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

            $stock_out_product = array();
            $order_code = time() . "_" . mt_rand(1000, 100000);

            for ($i = 0; $i < sizeof($product_codes); $i++) {
                if ($product_codes[$i] != null) {
                    $product_details = $this->getProductCodeAndPrice($product_codes[$i]);

                    if ($product_qty[$i] == 0 || $product_qty[$i] == "") {
                        $qty = 1;
                    } else {
                        $qty = $product_qty[$i];
                    }

                    if ($product_details->discounts) {
                        $discount_amount = $this->calculateDiscountAmount($product_details->price, $product_details->discounts->dis_percentage);
                        $discounted_price = $product_details->price - $discount_amount;
                    } else {
                        $discount_amount = 0;
                        $discounted_price = 0;
                    }

                    if ($qty > $product_details->stock) {
                        array_push($stock_out_product, $product_codes[$i]);
                        continue;
                    }

                    $order = new Order();
                    $order->pid = $product_details->id;
                    $order->order_code = $order_code;
                    $order->customer_id = $customer_details->id;
                    $order->product_qty = $qty;
                    $order->product_price = $product_details->price;
                    $order->subtotal = $qty * $product_details->price;
                    $order->discount_amount = $qty * $discount_amount;
                    $order->save();

                    $this->updateProductStock($product_details->id, $qty);
                }
            }

            DB::commit();
            if (!empty($stock_out_product)) {
                $stock_out_product_list = implode(" and ", $stock_out_product);
                $this->common->sendAPIRequest($this->text_message->sendTextMessage("Product " . $stock_out_product_list . "
                                        is out of stock. We enlisted them as pre-order. We will notify you as soon as they are available.Thanks"));
                //Store order as pre-order for this products
            }
            $this->processReceipt($data['customer_fb_id'], $order_code);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->common->sendAPIRequest($this->text_message->sendTextMessage("Your order cannot be processed. Please try again!"));
            $this->common->sendAPIRequest($this->template->orderFormTemplate());
        }
    }

    public function processReceipt($recipient_id, $order_code)
    {
        $placed_order_data = Order::where('order_code', $order_code)->with('products')->with('customers')->get();
        $this->job_controller->sendReceiptJob($recipient_id, $placed_order_data);
    }

    public function getProductCodeAndPrice($product_code)
    {
        return Product::select('id', 'price', 'stock')->where('code', $product_code)->with('discounts')->first();
    }

    public function updateProductStock($product_id, $qty)
    {
        Product::where('id', $product_id)->decrement('stock', $qty);
    }

    public function checkProductCode(Request $request)
    {
        if (!(Product::where('code', $request->product_code)->count() > 0)) {
            return response()->json(false);
        }
        return response()->json(true);
    }

    public function checkProductQty(Request $request)
    {
        return Product::select('stock')->where('code', $request->product_code)->first();
    }

    public function calculateDiscountAmount($product_price, $dis_percentage)
    {
        return ($product_price * $dis_percentage) / 100;
    }

    public function viewTrackOrderForm()
    {
        return view("orders.track_order_form");
    }

    public function getOrderStatus(Request $request)
    {
        $order_status = Order::where('order_code', $request->order_code)->with('products')->get();
        return response()->json($order_status);
    }

    public function storePreOrder(Request $request)
    {
        $customer_id = Customer::select('id')->where('fb_id', $request->customer_fb_id)->first();
        $product_id = Product::select('id')->where('code', $request->pre_order_product_code)->first();
        $pre_order_exists = PreOrder::where('pid', $product_id->id)->where('customer_id', $customer_id->id)->first();

        if ($pre_order_exists) {
            return response()->json("Already Pre Ordered");
        } else {
            $this->job_controller->storePreOrderJob($request->all());
            return response()->json("Pre Order Request Successful! You will be notified when product is available");
        }
    }

    public function processPreOrder($data)
    {
        try {
            $this->text_message = new TextMessages($data['customer_fb_id']);
            $customer_id = Customer::select('id')->where('fb_id', $data['customer_fb_id'])->first();
            $product_id = Product::select('id')->where('code', $data['pre_order_product_code'])->first();

            $pre_order = new PreOrder();
            $pre_order->pid = $product_id->id;
            $pre_order->customer_id = $customer_id->id;
            $pre_order->customer_fb_id = $data['customer_fb_id'];
            $pre_order->save();
        } catch (\Exception $e) {
            dd($e);
            $this->common->sendAPIRequest($this->text_message->sendTextMessage("Your Pre-Order Request Failed. Try Again!"));
        }
    }


    //test function
    public function getTestData()
    {
        $dd = Order::where('order_code', '1590432293_84634')->with('products')->get();
        dd($dd);

        $p = array();
        foreach ($dd as $d) {
            array_push($p, [
                "title" => $d->products->name,
                "subtitle" => "100% Soft and Luxurious Cotton",
                "quantity" => $d->product_qty,
                "price" => $d->product_price,
                "currency" => "BDT",
                "image_url" => "http://134.209.108.173/uploads/C05V0144_mega_handover.png"
            ]);
        }
        return response()->json($p);
    }
}
