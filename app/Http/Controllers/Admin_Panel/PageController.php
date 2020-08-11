<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Shop;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function storePages(Request $request)
    {
        $user_access_token = $request->facebook_api_response['authResponse']['accessToken'];
        $user_id = $request->facebook_api_response['authResponse']['userID'];
        $connection_status = $request->facebook_api_response['status'];
        $pages_details = json_decode($this->sendAPIRequest($user_access_token, $user_id), true);

        if ($connection_status === 'connected') {
            if(empty($pages_details['data'])){
                $this->updatePageAddedStatus($user_id, $user_access_token, false);
                return response()->json('no_page_added');
            }else {
                for ($i = 0; $i < sizeof($pages_details['data']); $i++) {
                    $page_contact = null;
                    $page_address = null;
                    $page_username = null;
                    $page_web_link = null;

                    if (array_key_exists('phone', $pages_details['data'][$i])) {
                        $page_contact = $pages_details['data'][$i]['phone'];
                    }

                    if (array_key_exists('single_line_address', $pages_details['data'][$i])) {
                        $page_address = $pages_details['data'][$i]['single_line_address'];
                    }

                    if (array_key_exists('username', $pages_details['data'][$i])) {
                        $page_username = $pages_details['data'][$i]['username'];
                    }

                    if (array_key_exists('website', $pages_details['data'][$i])) {
                        $page_web_link = $pages_details['data'][$i]['website'];
                    }
                    $page = Shop::where('page_id', $pages_details['data'][$i]['id'])->first();
                    if (!$page) {
                        Shop::create([
                            'page_name' => $pages_details['data'][$i]['name'],
                            'page_id' => $pages_details['data'][$i]['id'],
                            'page_access_token' => $pages_details['data'][$i]['access_token'],
                            'page_owner_id' => $user_id,
                            'page_contact' => $page_contact,
                            'page_likes' => $pages_details['data'][$i]['fan_count'],
                            'is_published' => $pages_details['data'][$i]['is_published'],
                            'is_webhooks_subscribed' => $pages_details['data'][$i]['is_webhooks_subscribed'],
                            'page_username' => $page_username,
                            'page_address' => $page_address,
                            'page_web_link' => $page_web_link,
                            'page_connected_status' => true,
                        ]);
                    }
                }
                $this->updatePageAddedStatus($user_id, $user_access_token, true);
            }
            return response()->json("success");
        } else {
            return response()->json("failed");
        }

    }

    function updatePageAddedStatus($user_id, $user_access_token, $page_added_status)
    {
        User::where('user_id', $user_id)
            ->update(
                [
                    'long_lived_user_token' => $user_access_token,
                    'page_added'=> $page_added_status
                ]);
    }

    public function sendAPIRequest($user_access_token, $user_id)
    {
        $ch = curl_init('https://graph.facebook.com/' . $user_id . '/accounts?fields=name,access_token,fan_count,is_published,is_webhooks_subscribed,phone,single_line_address,username,website&access_token=' . $user_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }
}
