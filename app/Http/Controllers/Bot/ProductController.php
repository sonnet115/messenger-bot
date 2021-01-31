<?php

namespace App\Http\Controllers\Bot;

use App\AutoReply;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function viewProductSearchForm(Request $request)
    {
        $customer_id = $request->segment(4);
        $page_id = $request->segment(2);
        $shop = Shop::where('page_id', request()->segment(2))->first();
        $categories = Category::where("parent_id", NUll)->where('shop_id', $shop->id)->with("subCategory")->with("products")->get();
        //dd($categories);
        $page_name = Shop::select('page_name')->where("page_id", $page_id)->first();

        return view("bot.products.products_search_form")
            ->with('customer_id', $customer_id)
            ->with('page_id', $page_id)
            ->with('categories', $categories)
            ->with('title', 'Products || ' . $page_name['page_name']);
    }

    public function viewAutoReplyProducts(Request $request)
    {
        $customer_id = $request->segment(4);
        $page_id = $request->segment(2);
        $post_id = $request->segment(5);
        $shop = Shop::select('page_name')->where("page_id", $page_id)->first();

        return view("bot.auto_reply.products")
            ->with('customer_id', $customer_id)
            ->with('page_id', $page_id)
            ->with('post_id', $post_id)
            ->with('title', 'Products || ' . $shop['page_name']);
    }

    public function getProduct(Product $products)
    {
        $shop = Shop::where('page_id', request()->segment(2))->first();
        /*$products = Product::where('code', request()->product_code)->where('shop_id', $shop->id)->where('state', 1)
            ->orWhere('name', 'like', '%' . request()->product_code . '%')->where('shop_id', $shop->id)->where('state', 1)
            ->with('images')
            ->with('discounts')->paginate(10);*/
        if (request()->cat_id == 0) {
            $products = Product::where('shop_id', $shop->id)
                ->where('state', 1)
                ->where('show_in_bot', 1)
                ->with('images')
                ->with('discounts')->paginate(2);
        } else {
            $products = Product::where('category_id', request()->cat_id)
                ->where('shop_id', $shop->id)
                ->where('state', 1)
                ->where('show_in_bot', 1)
                ->with('images')
                ->with('discounts')->paginate(2);
        }
        $products = Product::where('parent_product_id', '=', null)->with(['variants' => function ($query) {
                $query->groupBy('variant_id', 'product_id');
            }])
            ->where('shop_id', $shop->id)
            ->where('state', 1)
            ->where('show_in_bot', 1)
            ->with('childProducts')->paginate(20);

        return response()->json($products);
    }

    public function getAutoReplyProducts(Request $request)
    {
        $auto_reply = AutoReply::where('post_id', $request->post_id)->first();
        if ($auto_reply) {
            $products = AutoReply::find($auto_reply->id)->auto_reply_products()->with('discounts')->with('images')->paginate(2);
        } else {
            return null;
        }
        return response()->json($products);
    }
}
