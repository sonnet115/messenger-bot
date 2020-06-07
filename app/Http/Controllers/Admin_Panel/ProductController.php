<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function viewAddProductForm()
    {
        return view('admin_panel.product.add_product_form')->with("title", "CBB | Add Product");
    }

    public function storeProduct(Request $request)
    {
        //product validation
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,name',
            'product_code' => 'required|unique:products,code',
            'product_stock' => 'required|string|max:50',
            'product_uom' => 'required|string|max:50',
            'product_price' => 'required|string|max:50',
            'product_images.*' => 'mimes:jpeg,png,jpg',
        ]);

        if ($request->hasfile('product_images')) {
            if (sizeof($request->product_images) > 5) {
                Session::flash('error_image_count', 'Maximum 5 Images');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //product save
        $product = new Product();
        $product->name = $request->product_name;
        $product->code = $request->product_code;
        $product->stock = $request->product_stock;
        $product->uom = $request->product_uom;
        $product->price = $request->product_price;
        $product->save();
        $product_id = $product->id;

        //product image save
        if ($request->hasfile('product_images')) {
            foreach ($request->product_images as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/site_images/product_images/', $name);

                $productImage = new ProductImage();
                $productImage->pid = $product_id;
                $productImage->image_url = $name;
                $productImage->save();
            }
        }
        return redirect(route('product.add.view'));
    }

    public function viewUpdateProduct()
    {
        return view("admin_panel.product.manage_product")->with("title", "CBB | Manage Product");;
    }

    public function getProduct()
    {
       return datatables(Product::selectRaw(" * ")->whereRaw(1)->orderBy('id', 'asc')->with("images"))->toJson();
    }


}
