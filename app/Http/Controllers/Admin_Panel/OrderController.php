<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function viewUpdateOrder(){
        return view('admin_panel.orders.manage_order')->with("title"," CBB || Manage Orders");
    }

    public function getOrders(){
        return datatables(Order::selectRaw("*")->whereRaw(1)->orderBy('id', 'asc'))->toJson();

    }
    public function getOrdersDetails(Request $request){
           // $order =new Order();
            //$data=Order::all();
            $order_id=$request->order_id;
            $data = Order::where('id', $order_id)->with('ordered_products')->first();

            //dd($data);
            if($data){
                return response()->json($data);
            }

    }

    public function getProductStatus(Request $request){
            $status= $request->product_status;
            $product_id= $request->product_id;
            $order_id= $request->order_id;
            $order=OrderedProducts::where('oid',$order_id)->where('pid',$product_id)->update(['product_status' => $status]);
            if($order){
                return response()->json($order);
            }


    }
}
