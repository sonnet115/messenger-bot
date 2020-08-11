<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function viewAddProductForm()
    {
        if (request()->get('mode')) {
            $pid = request()->get('pid');
            $product_details = Product::where('id', $pid)->with('images')->first();
        } else {
            $product_details = null;
        }
        return view('admin_panel.product.add_product_form')->with("title", "CBB | Add Product")->with('product_details', $product_details);
    }

    public function storeProduct(Request $request)
    {
        //product validation
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:30',
            'product_code' => 'required|unique:products,code|max:15',
            'product_stock' => 'required|integer|max:100000',
            'product_uom' => 'required|string|max:10',
            'product_price' => 'required|numeric|between:0,500000',
            'product_image_1' => 'required|file|max:1024',
            'product_image_1.*' => 'mimes:jpeg,png,jpg',
            'product_image_2' => 'file|max:1024',
            'product_image_2.*' => 'mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            //product save
            $product = new Product();
            $product->name = $request->product_name;
            $product->code = $request->product_code;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->shop_id = 1;
            $product->save();
            $product_id = $product->id;


            //product image save
            $this->storeProductImage($request, $product_id, 'product_image_1', 1);
            $this->storeProductImage($request, $product_id, 'product_image_2', 2);

            DB::commit();
            Session::flash('success_message', 'Product added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('product.add.view'));
    }

    public function viewUpdateProduct()
    {
        return view("admin_panel.product.manage_product")->with("title", "CBB | Manage Product");
    }

    public function getProduct(Request $request)
    {
        $and = "";

        //filter option for stock from stock to and status
        if (request()->has('stock_from') && request()->has('stock_to') && request('stock_from') != null
            && request('stock_to') != null) {
            $and .= " AND stock >= " . request('stock_from') . " AND stock <= " . request('stock_to');
        }

        if (request()->has('status') && request('status') != null) {
            $and .= " AND state = " . request('status');
        }

        if (auth()->user()->page_added > 0) {
            return datatables(Product::selectRaw(" * ")->whereRaw(1 . $and)->orderBy('id', 'asc')->with("images"))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateProduct(Request $request)
    {
        $rules = array(
            'product_name' => 'required|max:30',
            'product_stock' => 'required|integer|max:100000',
            'product_uom' => 'required|string|max:10',
            'product_price' => 'required|numeric|between:0,500000',
            'product_image_1' => 'file|max:1024',
            'product_image_1.*' => 'mimes:jpeg,png,jpg',
            'product_image_2' => 'file|max:1024',
            'product_image_2.*' => 'mimes:jpeg,png,jpg',
        );
        if ($request->product_code !== $request->old_product_code) {
            $rules['product_code'] = 'required|unique:products,code|max:15';
        } else {
            $rules['product_code'] = 'required|max:15';
        }
        //product validation
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            //product save
            $product = Product::find($request->product_id);
            $product->code = $request->product_code;
            $product->name = $request->product_name;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->state = $request->product_state;
            $product->save();

            //product image save
            if ($request->hasfile('product_image_1')) {
                $this->updateProductImage($request, 'product_image_1', 1);
            }
            if ($request->hasfile('product_image_2')) {
                $this->updateProductImage($request, 'product_image_2', 2);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('product.manage.view'));
    }

    public function storeProductImage($request, $product_id, $image, $image_no)
    {
        if ($request->hasfile($image)) {
            $file = $request->file($image);
            $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
            $shop_name = 'shop_1';
            $file->move(public_path() . '/images/products/' . $shop_name . '/', $image_name);

            $productImage = new ProductImage();
            $productImage->pid = $product_id;
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        }
    }

    public function updateProductImage($request, $image, $image_no)
    {
        $file = $request->file($image);
        $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
        $shop_name = 'shop_1';
        $file->move(public_path() . '/images/products/' . $shop_name . '/', $image_name);

        $image_id = 0;
        if ($image_no === 1) {
            $image_id = $request->image_1_id;
        } else {
            $image_id = $request->image_2_id;
        }

        $productImage = ProductImage::where('id', $image_id)->first();
        if ($productImage) {
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        } else {
            $productImage = new ProductImage();
            $productImage->pid = $request->product_id;
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        }

    }

}
