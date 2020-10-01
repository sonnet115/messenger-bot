<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Discount;
use App\Http\Controllers\Controller;
use App\Product;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function viewAddDiscountForm()
    {
        if (request()->get('mode')) {
            $did = request()->get('did');
            $discount_details = Discount::where('id', $did)->first();
        } else {
            $discount_details = null;
        }

        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();

        return view("admin_panel.discount.add_discount_form")
            ->with("title", "Howkar Technology | Add Discount")
            ->with('discount_details', $discount_details)
            ->with('shop_list', $shops);
    }

    public function viewUpdateDiscount()
    {
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        $shops_id = array();
        foreach ($shops as $key => $value) {
            array_push($shops_id, $value['id']);
        }
        $products = Product::select('name', 'id')->whereIn('shop_id', $shops_id)->get();

        return view("admin_panel.discount.manage_discount")->with("title", "CBB | manage Discount")->with('products', $products);
    }

    public function storeDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_from' => 'required',
            'discount_to' => 'required',
            'product_id' => 'required',
            'shop_id' => 'required',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $discount = new Discount();
        $discount->name = $request->discount_name;
        $discount->dis_from = $request->discount_from;
        $discount->dis_to = $request->discount_to;
        $discount->pid = $request->product_id;
        $discount->dis_percentage = $request->discount_percentage;
        $discount->shop_id = $request->shop_id;
        $discount->save();
        return redirect(route('discount.add.view'));
    }

    public function getDiscount(Request $request)
    {
        $start_date = "";
        $end_date = "";
        $date_range = "";
        $pid = "";

        if (request()->has('start_date') && request('start_date') != null && request('end_date') == null) {
            $start_date = " AND dis_from = '" . request('start_date') . "'";
        }

        if (request()->has('end_date') && request('end_date') != null && request('start_date') == null) {
            $end_date = " AND dis_to = '" . request('end_date') . "'";
        }

        if (request()->has('start_date') && request()->has('end_date') && request('start_date') != null && request('end_date') != null) {
            $date_range = " AND dis_from >= '" . request('start_date') . "' AND dis_to <= '" . request('end_date') . "'";
        }

        if (request()->has('pid') && request('pid') != "") {
            $pid = " and pid IN(" . implode(',', request('pid')) . ")";
        }

        if (auth()->user()->page_added > 0) {
            return datatables(Discount::selectRaw("*")->whereRaw(1 . $date_range . $pid . $start_date . $end_date)->orderBy('id', 'asc')->with('product')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_from' => 'required',
            'discount_to' => 'required',
            'product_id' => 'required',
            'shop_id' => 'required',
            'discount_percentage' => 'required|numeric|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $discount = Discount::find($request->discount_id);
        $discount->name = $request->discount_name;
        $discount->dis_from = $request->discount_from;
        $discount->dis_to = $request->discount_to;
        $discount->pid = $request->product_id;
        $discount->dis_percentage = $request->discount_percentage;
        $discount->shop_id = $request->shop_id;
        $discount->save();

        return redirect(route('discount.manage.view'));
    }

}
