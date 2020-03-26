<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Jobs\OrderHandler;
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

    public function storeOrderQueue(Request $request)
    {
        dispatch(new OrderHandler($request->all()))->delay(now()->addSeconds(20));
        return response()->json("Order Placed Successfully. You will get receipt shortly.");
    }

    public function checkProductCode(Request $request)
    {
        if (!(Product::where('code', $request->product_code)->count() > 0)) {
            return response()->json(false);
        }
        return response()->json(true);
    }
}
