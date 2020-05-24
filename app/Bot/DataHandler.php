<?php

namespace App\Bot;

use App\Customer;
use Illuminate\Support\Facades\Session;

class DataHandler
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function storeUserInfo()
    {
        $customer_exists = Customer::where("fb_id", $this->user_id)->get();
        if (count($customer_exists) <= 0) {
            $user_info = $this->profileAPIRequest();
            $customer = new Customer();
            $customer->fb_id = $this->user_id;
            $customer->first_name = $user_info['first_name'];
            $customer->last_name = $user_info['last_name'];
            $customer->profile_pic = $user_info['profile_pic'];
            $customer->save();
        }
    }

    private function profileAPIRequest()
    {
        $ch = curl_init('https://graph.facebook.com/' . $this->user_id . '?fields=first_name,last_name,profile_pic&access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        return json_decode($result, true);
    }

}
