<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $user_id;

    public function viewOrderForm(Request $request)
    {
        $this->user_id = $request->segment(2);
        $get_user_info = Customer::where('fb_id', $this->user_id)->first();
        return view("orders.order_form")->with("user_info", $get_user_info);
    }
}
