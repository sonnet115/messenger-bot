<?php

namespace App\Http\Controllers\Bot;

use App\Bot\Webhook\Entry;
use App\Http\Controllers\Controller;
use App\Jobs\Bot\BotHandler;
use App\Shop;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function verifyWebhook(Request $request)
    {
        $entries = Entry::getEntries($request);
        foreach ($entries as $entry) {
            $data = $entry->getMessagings();
            foreach ($data as $messaging) {
                $shop = Shop::where('page_id', $messaging->getRecipientId())->first();
                dispatch(new BotHandler($messaging, $shop->page_access_token));
            }
        }
        return json_encode(response());
    }

    public function showHome(){
        echo 'home';
    }
}
