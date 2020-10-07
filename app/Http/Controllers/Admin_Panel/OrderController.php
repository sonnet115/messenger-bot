<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderedProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Shop;

class OrderController extends Controller
{
    public function viewManageOrder()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view('admin_panel.orders.manage_order')
            ->with("title", " Howkar Technology || Manage Orders")
            ->with('shops', $shops);
    }

    public function getOrders()
    {
        return datatables(Order::selectRaw("*")->whereRaw(1)->orderBy('id', 'asc')->with('status_updated_by'))->toJson();
    }

    public function getOrdersDetails(Request $request)
    {
        $order_id = $request->order_id;
        $data = Order::where('id', $order_id)->with('ordered_products')->first();
        if ($data) {
            return response()->json($data);
        }
    }

    public function getProductStatus(Request $request)
    {
        $status = $request->product_status;
        $product_id = $request->product_id;
        $order_id = $request->order_id;
        $order = OrderedProducts::where('oid', $order_id)->where('pid', $product_id)->update(['product_status' => $status]);
        if ($order) {
            $result = DB::table('ordered_products')->select('product_status', 'quantity', 'price', 'discount')
                ->where('oid', $order_id)->where('pid', $product_id)->first();
            return response()->json($result);
        }
    }

    public function changeOrderStatus(Request $request)
    {
        try {
            $order_id = $request->order_id;
            $order_status = $request->order_status;

            $order = Order::find($order_id);
            $order->order_status = $order_status;
            $order->status_updated_by = auth()->user()->id;
            $order->save();

            return response()->json('Successfully updated status', 200);
        } catch (\Exception $e) {
            return response()->json('Update Failed', 400);
        }
    }
}
