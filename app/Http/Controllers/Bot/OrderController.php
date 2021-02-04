<?php

namespace App\Http\Controllers\Bot;

use App\Bot\Common;
use App\Bot\Template;
use App\Bot\TextMessages;
use App\Cart;
use App\Customer;
use App\DeliveryCharge;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderedProducts;
use App\PreOrder;
use App\Product;
use App\ProductImage;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $common;
    private $text_message;
    private $template;
    private $job_controller;
    private $customer_fb_id_segment = 4;
    private $app_id_segment = 2;
    private $customer_fb_id;
    private $app_id;
    private $shop;
    private $shop_id;
    private $page_token;

    public function __construct()
    {
        $this->customer_fb_id = request()->segment($this->customer_fb_id_segment);
        $this->app_id = request()->segment($this->app_id_segment);
        $this->shop = Shop::where('page_id', $this->app_id)->first();
        $this->shop_id = $this->shop->id;
        $this->page_token = $this->shop->page_access_token;

        $this->common = new Common($this->page_token);
        $this->job_controller = new JobController();
    }

    public function viewCheckoutForm(Request $request)
    {
        $get_customer_info = Customer::where('fb_id', $this->customer_fb_id)->first();
        $delivery_charges = DeliveryCharge::where('shop_id', $this->shop_id)->get();
        $page_id = $request->segment($this->app_id_segment);
        return view("bot.orders.check_out")
            ->with("customer_info", $get_customer_info)
            ->with('app_id', $this->app_id)
            ->with('delivery_charges', $delivery_charges)
            ->with('title', 'Cart || ' . $this->shop->page_name);
    }

    //Functions for carts
    public function addToCart(Request $request)
    {
        $customer_id = Customer::select('id')->where('fb_id', $request->customer_fb_id)->first();
        $product_id = Product::select('id')->where('id', $request->cart_product_id)->first();
        $product_exists_in_cart = Cart::where('pid', $product_id->id)->where('customer_id', $customer_id->id)->first();

        if ($product_exists_in_cart) {
            return response()->json("Already In Cart", 409);
        } else {
            try {
                $this->text_message = new TextMessages($request->customer_fb_id);
                $cart = new Cart();
                $cart->pid = $product_id->id;
                $cart->customer_id = $customer_id->id;
                $cart->customer_fb_id = $request->customer_fb_id;
                $cart->shop_id = $this->shop_id;
                $cart->save();
                return response()->json("Added To Cart", 200);
            } catch (\Exception $e) {
                return response()->json("Couldn't add to cart", 400);
            }
        }
    }

    public function getCartProducts(Request $request)
    {
        $cart_products = Cart::where('customer_fb_id', $request->customer_fb_id)->with('products')->get();
        return response()->json($cart_products);
    }

    public function removeCartProducts(Request $request)
    {
        if ($this->processRemoveCartProducts($request->product_id, $request->customer_fb_id)) {
            return response()->json("Product removed from cart successfully.", 200);
        } else {
            return response()->json("Cannot remove product. Please try again!", 400);
        }
    }

    public function processRemoveCartProducts($product_id, $customer_fb_id)
    {
        return Cart::where('pid', $product_id)->where('customer_fb_id', $customer_fb_id)->delete();
    }


    //Functions for orders
    public function storeOrder(Request $request)
    {
        $this->job_controller->storeOrderJob($request->all());
        return response()->json("Order Placed Successfully. You will get receipt shortly.");
    }

    public function processOrder($data)
    {
        $this->text_message = new TextMessages($data['customer_fb_id']);
        $this->template = new Template($data['customer_fb_id'], $this->app_id);

        DB::beginTransaction();
        try {
            $customer_details = Customer::where('fb_id', $data['customer_fb_id'])->first();
            $customer_details->first_name = $data['first_name'];
            $customer_details->last_name = $data['last_name'];
            $customer_details->contact = $data['contact'];
            $customer_details->shipping_address = $data['shipping_address'];
            $customer_details->save();

            $product_ids = $data['product_id'];
            $product_qty = $data['product_qty'];

            $stock_out_product = array();

            $order = new Order();
            $order->customer_name = $data['first_name'] . " " . $data['last_name'];
            $order->customer_id = $customer_details->id;
            $order->contact = $data['contact'];
            $order->shipping_address = $data['shipping_address'];
            $order->shop_id = $this->shop_id;
            $order->delivery_charge = $data['delivery_charge'];
            $order->save();
            $order_id = $order->id;

            $order_code = str_pad($order_id, 5, "0", STR_PAD_LEFT) . mt_rand(0, 999);
            $order_code_update = Order::find($order_id);
            $order_code_update->code = $order_code;
            $order_code_update->save();

            for ($i = 0; $i < sizeof($product_ids); $i++) {
                if ($product_ids[$i] != null) {
                    $product_details = $this->getProductCodeAndPrice($product_ids[$i]);
                    if ($product_qty[$i] == 0 || $product_qty[$i] == "") {
                        $qty = 1;
                    } else {
                        $qty = $product_qty[$i];
                    }

                    if ($product_details->discounts) {
                        $discount_amount = $this->calculateDiscountAmount($product_details->price, $product_details->discounts->dis_percentage);
                        $discounted_price = $product_details->price - $discount_amount;
                    } else {
                        $discount_amount = 0;
                        $discounted_price = 0;
                    }

                    $this->processRemoveCartProducts($product_ids[$i], $data['customer_fb_id']);

                    //Pre order
                    /* if ($qty > $product_details->stock) {
                         array_push($stock_out_product, $product_codes[$i]);
                         continue;
                     }*/

                    $order = new OrderedProducts();
                    $order->oid = $order_id;
                    $order->pid = $product_details->id;
                    $order->quantity = $qty;
                    $order->price = $product_details->price;
                    $order->discount = $qty * $discount_amount;
                    $order->save();

                    $this->updateProductStock($product_details->id, $qty);
                }
            }

            DB::commit();

            //Pre order
            /*if (!empty($stock_out_product)) {
                $stock_out_product_list = implode(" and ", $stock_out_product);
                $this->common->sendAPIRequest($this->text_message->sendTextMessage("Product " . $stock_out_product_list . "
                                        is out of stock. We enlisted them as pre-order. We will notify you as soon as they are available.Thanks"));
                //Store order as pre-order for this products
                for ($i = 0; $i < sizeof($stock_out_product); $i++) {
                    $data = array(
                        'customer_fb_id' => $data['customer_fb_id'],
                        'pre_order_product_code' => $stock_out_product[$i],
                    );
                    $this->processPreOrder($data);
                }
            }*/
            $this->processReceipt($data['customer_fb_id'], $order_code);
        } catch (\Exception $e) {
            Log::channel('order')->info('order_failed: ' . json_encode($e) . PHP_EOL);
            DB::rollBack();
            $this->common->sendAPIRequest($this->text_message->sendTextMessage("Your order cannot be processed. Please try again!"));
            $this->common->sendAPIRequest($this->template->orderProductTemplate());
        }
    }

    public function processReceipt($recipient_id, $order_code)
    {
        $placed_order_data = Order::where('code', $order_code)->with('ordered_products')->first();
        $this->job_controller->sendReceiptJob($recipient_id, $placed_order_data, $this->page_token);
    }

    //Functions for Track orders
    public function viewTrackOrderForm(Request $request)
    {
        $customer_id = Customer::select('id')->where('fb_id', $this->customer_fb_id)->first();
        $order_status = Order::where('customer_id', $customer_id->id)->with('ordered_products')->get();
        return view("bot.orders.track_order_form")
            ->with("orders", $order_status)
            ->with("app_id", $this->app_id)
            ->with('title', 'Track Orders || ' . $this->shop->page_name);;
    }

    public function getOrderStatus(Request $request)
    {
        $order_status = Order::where('code', $request->order_code)->with('ordered_products')->first();
        return response()->json($order_status);
    }


    //Functions for Pre-order
    public function storePreOrder(Request $request)
    {
        $customer_id = Customer::select('id')->where('fb_id', $request->customer_fb_id)->first();
        $product_id = Product::select('id')->where('code', $request->pre_order_product_code)->where('shop_id', $this->shop_id)->first();
        $pre_order_exists = PreOrder::where('pid', $product_id->id)->where('customer_id', $customer_id->id)->first();

        if ($pre_order_exists) {
            return response()->json("Already Pre Ordered", 409);
        } else {
            $this->job_controller->storePreOrderJob($request->all());
            return response()->json("Pre Order Request Successful! You will be notified when product is available", 200);
        }
    }

    public function processPreOrder($data)
    {
        try {
            $this->text_message = new TextMessages($data['customer_fb_id']);
            $customer_id = Customer::select('id')->where('fb_id', $data['customer_fb_id'])->first();
            $product_id = Product::select('id')->where('code', $data['pre_order_product_code'])->where('shop_id', $this->shop_id)->first();
            $pre_order_exists = PreOrder::where('pid', $product_id->id)->where('customer_id', $customer_id->id)->first();

            if (!$pre_order_exists) {
                $pre_order = new PreOrder();
                $pre_order->pid = $product_id->id;
                $pre_order->customer_id = $customer_id->id;
                $pre_order->customer_fb_id = $data['customer_fb_id'];
                $pre_order->shop_id = $this->shop_id;
                $pre_order->save();
            }
        } catch (\Exception $e) {
            $this->common->sendAPIRequest($this->text_message->sendTextMessage("Your Pre-Order Request Failed. Try Again!"));
        }
    }


    //Helper Functions
    public function getProductCodeAndPrice($product_id)
    {
        return Product::select('id', 'price', 'stock')->where('id', $product_id)->where('shop_id', $this->shop_id)->with('discounts')->first();
    }

    public function updateProductStock($product_id, $qty)
    {
        Product::where('id', $product_id)->decrement('stock', $qty);
    }

    public function checkProductCode(Request $request)
    {
        if (!(Product::where('code', $request->product_code)->count() > 0)) {
            return response()->json(false);
        }
        return response()->json(true);
    }

    public function checkProductQty(Request $request)
    {
        return Product::select('stock')->where('code', $request->product_code)->where('shop_id', $this->shop_id)->first();
    }

    public function calculateDiscountAmount($product_price, $dis_percentage)
    {
        return ($product_price * $dis_percentage) / 100;
    }


    //test function
    public function getTestData()
    {
        $placed_order_data = Order::where('code', '1600337860_50691')->with('ordered_products')->first();

        $products = array();
        foreach ($placed_order_data->ordered_products as $product) {
            $product_image = ProductImage::where('pid', $product->id)->first();
            $absolute_url = 'https://clients.howkar.com/images/products/' . $product_image->image_url;
            array_push($products, [
                "title" => $product->name,
                "subtitle" => "Product_Code:" . $product->code,
                "quantity" => $product->pivot->quantity,
                "price" => $product->pivot->price,
                "currency" => "BDT",
                "image_url" => $absolute_url
            ]);
        }
        return response()->json($products);
    }
}
