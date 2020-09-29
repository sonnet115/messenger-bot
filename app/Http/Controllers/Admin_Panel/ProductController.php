<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Query;

class ProductController extends Controller
{
    private $shops;

    public function __construct()
    {

    }

    public function viewAddProductForm()
    {
        if (request()->get('mode')) {
            $pid = request()->get('pid');
            $product_details = Product::where('id', $pid)->with('images')->with('shop')->first();
            if ($product_details->shop->page_connected_status != 1) {
                return redirect(route('product.manage.view'));
            }

            if ($product_details->shop->page_owner_id !== auth()->user()->user_id) {
                return redirect(route('product.manage.view'));
            }
        } else {
            $product_details = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();

        return view('admin_panel.product.add_product_form')
            ->with("title", "CBB | Add Product")
            ->with('product_details', $product_details)
            ->with('shop_list', $shops);
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
            'shop_id_name' => 'required',
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
            $shop_name = str_replace(' ', '_', explode('_', $request->shop_id_name)[1]);
            //product save
            $product = new Product();
            $product->name = $request->product_name;
            $product->code = $request->product_code;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->save();
            $product_id = $product->id;

            //product image save
            $this->storeProductImage($request, $product_id, 'product_image_1', 1, $shop_name);
            $this->storeProductImage($request, $product_id, 'product_image_2', 2, $shop_name);

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
        return view("admin_panel.product.manage_product")->with("title", "Howkar Technology || Manage Product");
    }

    public function getProduct(Request $request, Product $product)
    {
        $product = $product->newQuery();

        if (request()->has('stock_from') && request()->has('stock_to') && request('stock_from') != null
            && request('stock_to') != null) {
            $product->where('stock', '>=', request('stock_from'))
                ->where('stock', '<=', request('stock_to'));
        }

        if (request()->has('status') && request('status') != null) {
            $product->where('state', '=', request('status'));
        }
        $this->shops = Shop::select('id')->where('page_owner_id', auth()->user()->user_id)->get()->toArray();

        $product->whereIn('shop_id', array(($this->shops)));

        if (auth()->user()->page_added > 0) {
            return datatables($product->orderBy('id', 'asc')->with("images")->with('shop'))->toJson();
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
            'shop_id_name' => 'required',
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
            $shop_name = str_replace(' ', '_', explode('_', $request->shop_id_name)[1]);
            //product save
            $product = Product::find($request->product_id);
            $product->code = $request->product_code;
            $product->name = $request->product_name;
            $product->stock = $request->product_stock;
            $product->uom = $request->product_uom;
            $product->price = $request->product_price;
            $product->state = $request->product_state;
            $product->shop_id = explode('_', $request->shop_id_name)[0];
            $product->save();

            //product image save
            if ($request->hasfile('product_image_1')) {
                $this->updateProductImage($request, 'product_image_1', 1, $shop_name);
            }
            if ($request->hasfile('product_image_2')) {
                $this->updateProductImage($request, 'product_image_2', 2, $shop_name);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error_message', 'Something went wrong! Please Try again');
        }

        return redirect(route('product.manage.view'));
    }

    public function storeProductImage($request, $product_id, $image, $image_no, $shop_name)
    {
        if ($request->hasfile($image)) {
            $file = $request->file($image);
            $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
            $shop_name = $shop_name;
            $file->move(public_path() . '/images/products/' . $shop_name . '/', $image_name);

            $productImage = new ProductImage();
            $productImage->pid = $product_id;
            $productImage->image_url = $shop_name . '/' . $image_name;
            $productImage->save();
        }
    }

    public function updateProductImage($request, $image, $image_no, $shop_name)
    {
        $file = $request->file($image);
        $image_name = $request->product_code . '_' . $image_no . '.' . $file->extension();
        $shop_name = $shop_name;
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
