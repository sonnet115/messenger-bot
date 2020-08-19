<?php

namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProductSearchForm(Request $request)
    {
        $customer_id = $request->segment(4);
        $page_id = $request->segment(2);
        return view("bot.products.products_search_form")->with('customer_id', $customer_id)->with('page_id', $page_id);
    }

    public function getProduct(Request $request)
    {
        $shop = Shop::where('page_id', $request->segment(2))->first();
        $products = Product::where('code', $request->product_code)->where('shop_id', $shop->id)->where('state', 1)
            ->orWhere('name', 'like', '%' . $request->product_code . '%')->where('shop_id', $shop->id)  ->where('state', 1)
            ->with('images')
            ->with('discounts')->paginate(10);
        return response()->json($products);
    }

}
