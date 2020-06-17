<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Discount;
use App\Http\Controllers\Controller;
use App\Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    public function viewAddDiscountForm()
    {
        $Product_names = Product::select('name', 'id')->get();
        if (request()->get('did')) {
            $did = request()->get('did');
            $discount_details = Discount::where('id', $did)->first();
        } else {
            $discount_details = null;
        }
        return view("admin_panel.discount.add_discount_form")->with("title", "CBB | Add Discount")->with('discount_details', $discount_details)->with('product_names', $Product_names);
    }

    public function viewUpdateDiscount()
    {
        $data=Product::get('name','id');

        return view("admin_panel.discount.manage_discount")->with("title", "CBB | manage Discount")->with('product_name',$data);
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
        $discount = new Discount();
        $discount->name = $request->discount_name;
        $discount->dis_from = $request->discount_from;
        $discount->dis_to = $request->discount_to;
        $discount->pid = $request->product_id;
        $discount->dis_percentage = $request->discount_percentage;
        $discount->max_customers = $request->max_customer;
        $discount->shop_id = $shop_id;
        $discount->save();
        return redirect(route('discount.add.view'));

    }

    public function getDiscount(Request $request)
    {

        //if(request()->has('start_date') && request('start_date') !== "")
        if(!$request->start_date){
            return datatables(Discount::selectRaw("id,name,dis_from,dis_to,dis_percentage,max_customers")->whereRaw(1)->orderBy('id', 'asc'))->toJson();
        }
        else{
            $postsQuery = Discount::query();
            $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
            $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

            if ($start_date && $end_date) {

                $start_date = date('Y-m-d', strtotime($start_date));
                $end_date = date('Y-m-d', strtotime($end_date));

                $postsQuery->whereRaw("date(discounts.dis_from) >= '" . $start_date . "' AND date(discounts.dis_to) <= '" . $end_date . "'");
            }
            $posts = $postsQuery->select('*');
            return datatables()->of($posts)
                ->make(true);
        }


    }

    public function updateDiscount(Request $request)
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
        $discount = Discount::find($request->discount_id);
        $discount->name = $request->discount_name;
        $discount->dis_from = $request->discount_from;
        $discount->dis_to = $request->discount_to;
        $discount->pid = $request->product_id;
        $discount->dis_percentage = $request->discount_percentage;
        $discount->max_customers = $request->max_customer;
        $discount->shop_id = 1;
        $discount->save();
    }


}
