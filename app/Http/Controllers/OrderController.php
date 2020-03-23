<?php

namespace App\Http\Controllers;

use App\Customer;
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

        return response()->json($request->customer_fb_id);
    }
}
