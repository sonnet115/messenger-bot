<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewOrderForm(){
        return view("orders.order_form");
    }
}
