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
        $customer_id = $request->segment(3);
        return view("bot.products.products_search_form")->with('customer_id', $customer_id);
    }

    public function getProduct(Request $request)
    {
        $shop_id = Shop::where('shop_unique_id', env('SHOP_UNIQUE_ID'))->first();
        $products = Product::where('code', $request->product_code)
            ->orWhere('name', 'like', '%' . $request->product_code . '%')
            ->where('shop_id', $shop_id->id)
            ->where('state', 1)
            ->with('images')
            ->with('discounts')->paginate(10);
        return response()->json($products);
    }

}
