<?php

namespace App\Http\Controllers\Admin_Panel;

use App\DeliveryCharge;
use App\Discount;
use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeliveryChargeController extends Controller
{
    public function viewAddDeliveryChargeForm()
    {
        if (request()->get('mode')) {
            $dcid = request()->get('dcid');
            $dc_details = DeliveryCharge::where('id', $dcid)->first();
        } else {
            $dc_details = null;
        }
        $shops = Shop::where('page_owner_id', auth()->user()->user_id)->where('page_connected_status', 1)->get();
        return view("admin_panel.delivery_charges.add_dc_form")
            ->with("title", "CBB | Add Delivery Charge")
            ->with('dc_details', $dc_details)
            ->with('shop_list', $shops);
    }

    public function storeDeliveryCharge(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'dc_name' => 'required',
            'dc_amount' => 'required|numeric',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dc = new DeliveryCharge();
        $dc->name = $request->dc_name;
        $dc->delivery_charge = $request->dc_amount;
        $dc->shop_id = $request->shop_id;
        $dc->save();
        return redirect(route('dc.add.view'));
    }

    public function viewDeliveryChargeList()
    {
        return view("admin_panel.delivery_charges.dc_lists")->with("title", "CBB | DC Manage");
    }

    public function getDeliveryCharges(Request $request)
    {
        if (auth()->user()->page_added > 0) {
            return datatables(DeliveryCharge::selectRaw("*")->orderBy('id', 'asc')->with('shop'))->toJson();
        } else {
            return datatables(array())->toJson();
        }
    }

    public function updateDeliveryCharge(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dc_name' => 'required',
            'dc_amount' => 'required|numeric',
            'shop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dc = DeliveryCharge::find($request->dc_id);
        $dc->name = $request->dc_name;
        $dc->delivery_charge = $request->dc_amount;
        $dc->shop_id = $request->shop_id;
        $dc->save();
        return redirect(route('dc.list.view'));
    }

}
