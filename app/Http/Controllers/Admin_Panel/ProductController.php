<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\ProductImage;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /*add product*/
    public function viewAddProductForm()
    {
        return view('admin_panel.addProductForm');
    }

    public function storeProduct(Request $request)
    {
        //product validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
            'stock' => 'required|string|max:50',
            'uom' => 'required|string|max:50',
            'price' => 'required|string|max:50',
            //'filenames' => 'required',
            'filenames.*' => 'mimes:jpeg,png,jpg',
        ]);

        if($request->has('filenames')){
            if(sizeof($request->filenames)>2){
                Session::flash('error_image_count', 'Do not select more then 5 images');
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //product save
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->stock = $request->stock;
        $product->uom = $request->uom;
        $product->price = $request->price;

        $product->save();
        $product_id=$product->id;

        //product image save
        if ($request->hasfile('filenames')) {
            foreach ($request->filenames as $file) {
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
}
