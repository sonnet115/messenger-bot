<?php

namespace App\Http\Controllers\Bot;

use App\AutoReply\Webhook\AREntry;
use App\Http\Controllers\Controller;
use App\Jobs\Bot\BotHandler;
use Illuminate\Http\Request;

class BotController extends Controller
{
    /*public function verifyWebhook(Request $request)
    {
        return json_encode(response());
        $entries = Entry::getEntries($request);
        foreach ($entries as $entry) {
            $data = $entry->getMessagings();
            foreach ($data as $messaging) {
                $shop = Shop::where('page_id', $messaging->getRecipientId())->first();
                dispatch(new BotHandler($messaging, $shop->page_access_token));
            }
        }
        return json_encode(response());
    }*/

    public function verifyWebhook(Request $request)
    {
        //return json_encode(response());
        $entries = AREntry::getEntries($request);
        foreach ($entries as $entry) {
            $data = $entry->getChanges();
            foreach ($data as $changes) {
                dispatch(new BotHandler($changes, "apsdasdasd"));
            }
        }
        return json_encode(response());
    }

    public function showHome()
    {
        echo 'home';
    }
}
