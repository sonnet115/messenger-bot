<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewUpdateOrder(){
        return view('admin_panel.orders.manage_order')->with("title"," CBB || Manage Orders");
    }

    public function getOrders(){
        return datatables(Order::selectRaw("*")->whereRaw(1)->orderBy('id', 'asc'))->toJson();

    }
}
