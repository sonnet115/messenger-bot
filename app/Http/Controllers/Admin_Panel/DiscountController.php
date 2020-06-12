<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function viewAddDiscountForm()
    {
        return view("admin_panel.discount.add_discount_form")->with("title", "CBB | Add Discount");
    }

    public function viewUpdateDiscount()
    {
        return view("admin_panel.discount.manage_discount")->with("title", "CBB | manage Discount");
    }

    public function storeDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_name' => 'required|unique:discounts,name',
            'discount_from' => 'required',
            'discount_to' => 'required',
            'product_id' => 'required',
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'max_customer' => 'required|integer|max:100000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $shop_id = 1;
        $state=1;
        $discount = new Discount();
        $discount->name = $request->discount_name;
        $discount->dis_from = $request->discount_from;
        $discount->dis_to = $request->discount_to;
        $discount->pid = $request->product_id;
        $discount->dis_percentage = $request->discount_percentage;
        $discount->max_customers = $request->max_customer;
        $discount->shop_id = $shop_id;
        $discount->state = $state;
        $discount->save();
        return redirect(route('discount.add.view'));

    }
}
