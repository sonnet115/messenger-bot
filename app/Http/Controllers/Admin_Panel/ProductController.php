<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /*add product*/
    public function viewAddProductForm(){
            return view('admin_panel.addProductForm');
    }
    public function storeProduct(Request $request){
            $product=new Product();
            $product->name=$request->name;
            $product->code=$request->code;
            $product->stock=$request->stock;
            $product->uom=$request->uom;
            $product->price=$request->price;
            $product->save();
            return redirect(route('product.add.view'));


    }
}
