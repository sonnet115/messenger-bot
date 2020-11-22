<?php

namespace App\Bot;

use App\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DataHandler
{
    private $user_id;
    private $app_id;
    private $page_token;

    public function __construct($user_id, $app_id, $page_token)
    {
        $this->user_id = $user_id;
        $this->app_id = $app_id;
        $this->page_token = $page_token;
    }

    public function storeUserInfo()
    {
        $customer_exists = Customer::where("fb_id", $this->user_id)->get();
        if (count($customer_exists) <= 0) {
            $user_info = $this->profileAPIRequest();
            $customer = new Customer();
            $customer->fb_id = $this->user_id;
            $customer->app_id = $this->app_id;
            /*$customer->first_name = $user_info['first_name'];
            $customer->last_name = $user_info['last_name'];
            $customer->profile_pic = $user_info['profile_pic'];*/
            $customer->save();
        }
    }

    private function profileAPIRequest()
    {
        $ch = curl_init('https://graph.facebook.com/' . $this->user_id . '?fields=first_name,last_name&access_token=' . $this->page_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, false);
        $result = curl_exec($ch);
        Log::channel('store_user_info')->info('facebook profile response: ' . json_encode($result).PHP_EOL);
        return json_decode($result, true);
    }

}
