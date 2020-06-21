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
        $shop = Shop::where('app_id', $request->segment(2))->first();
        $entries = Entry::getEntries($request);
        foreach ($entries as $entry) {
            $messagings = $entry->getMessagings();
            foreach ($messagings as $messaging) {
                dispatch(new BotHandler($messaging, $shop->page_token));
            }
        }
        return json_encode(response());
    }
}
