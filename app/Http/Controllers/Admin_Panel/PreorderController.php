<?php

namespace App\Http\Controllers\Admin_panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function viewPreorderProduct(){
        return view("admin_panel.pre_orders.manage_preorder")->with("title", "CBB | manage Pre-Order");
    }
}
