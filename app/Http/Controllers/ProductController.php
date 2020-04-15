<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function viewProductSearchForm()
    {
        return view("products.products_search_form");
    }

    public function getProduct(Request $request)
    {
        $products = Product::where('code', $request->product_code)->get();
        return response()->json($products);
    }

}
