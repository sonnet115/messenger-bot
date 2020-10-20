<?php

namespace App\Http\Controllers\Bot;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected function getCategoryTree($level = NULL, $prefix = '')
    {
        $rows = Category::where("parent_id", $level)->with("subCategory")->get();

        $category = '';
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $category .= $prefix . $row->name . "\n";
                // Append subcategories
                $category .= $this->getCategoryTree($row->id, $prefix . '-');
            }
        }
        return $category;
    }

    public function printCategoryTree()
    {
        echo $this->getCategoryTree();
    }

    public function viewProductSearchForm(Request $request)
    {
        $customer_id = $request->segment(4);
        $page_id = $request->segment(2);
        $categories = Category::where("parent_id", NUll)->with("subCategory")->with("products")->get();
        $page_name = Shop::select('page_name')->where("page_id", $page_id)->first();

        return view("bot.products.products_search_form")
            ->with('customer_id', $customer_id)
            ->with('page_id', $page_id)
            ->with('categories', $categories)
            ->with('title', 'Products || ' . $page_name['page_name']);
    }

    public function getProduct(Request $request)
    {
        $shop = Shop::where('page_id', $request->segment(2))->first();
        $products = Product::where('code', $request->product_code)->where('shop_id', $shop->id)->where('state', 1)
            ->orWhere('name', 'like', '%' . $request->product_code . '%')->where('shop_id', $shop->id)->where('state', 1)
            ->with('images')
            ->with('discounts')->paginate(10);
        return response()->json($products);
    }

}
