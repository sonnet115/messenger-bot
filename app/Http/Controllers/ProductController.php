<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProductSearchForm(Request $request)
    {
        $customer_id = $request->segment(2);
        return view("products.products_search_form")->with('customer_id', $customer_id);
    }

    public function getProduct(Request $request)
    {
        $products = Product::where('code', $request->product_code)
            ->orWhere('name', 'like', '%' . $request->product_code . '%')
            ->with('images')
            ->with('discounts')->paginate(15);
        return response()->json($products);
    }

}
