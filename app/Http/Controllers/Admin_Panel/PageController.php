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
        $pages_details = json_decode($this->addPageToApp($user_access_token, $user_id), true);

        if ($connection_status === 'connected') {
            $this->updatePageConnectionStatus($user_id, null, false);
            if (empty($pages_details['data'])) {
                $this->updatePageAddedStatus($user_id, $user_access_token, false);
                return response()->json('no_page_added');
            } else {
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
                    } else {
                        $this->updatePageConnectionStatus(null, $pages_details['data'][$i]['id'], true);
                    }
                    $webhook_fields = json_decode($this->addFieldsToWebhook($pages_details['data'][$i]['access_token'], $pages_details['data'][$i]['id']));
                }
                $this->updatePageAddedStatus($user_id, $user_access_token, true);
            }
            return response()->json('success');
        } else {
            return response()->json("failed");
        }

    }

    function updatePageConnectionStatus($user_id, $page_id, $page_connection_status)
    {
        if ($user_id != null) {
            Shop::where('page_owner_id', $user_id)
                ->update(
                    [
                        'page_connected_status' => $page_connection_status,
                    ]);
        }

        if ($page_id != null) {
            Shop::where('page_id', $page_id)
                ->update(
                    [
                        'page_connected_status' => $page_connection_status,
                    ]);
        }
    }

    function updatePageAddedStatus($user_id, $user_access_token, $page_added_status)
    {
        User::where('user_id', $user_id)
            ->update(
                [
                    'long_lived_user_token' => $user_access_token,
                    'page_added' => $page_added_status
                ]);
    }

    function viewShopList()
    {
        return view("admin_panel.shop.shop_lists")->with("title", "CBB | Shops List");
    }

    function getShopsList()
    {
        return datatables(Shop::where('page_owner_id', auth()->user()->user_id))->toJson();
    }

    public function addPageToApp($user_access_token, $user_id)
    {
        $ch = curl_init('https://graph.facebook.com/' . $user_id . '/accounts?fields=name,access_token,fan_count,is_published,is_webhooks_subscribed,phone,single_line_address,username,website&access_token=' . $user_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }

    public function addFieldsToWebhook($page_access_token, $page_id)
    {
        $ch = curl_init('https://graph.facebook.com/v3.2/' . $page_id . '/subscribed_apps?subscribed_fields=messages,messaging_postbacks,messaging_optins&access_token=' . $page_access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        return curl_exec($ch);
    }
}
