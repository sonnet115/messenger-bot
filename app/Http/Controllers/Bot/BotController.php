<?php

namespace App\Http\Controllers\Bot;

use App\AutoReply;
use App\Bot\Webhook\Entry;
use App\Http\Controllers\Controller;
use App\Jobs\AutoReply\AutoReplyHandler;
use App\Jobs\Bot\BotHandler;
use App\Shop;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function verifyWebhook(Request $request)
    {
        //return json_encode(response());
        $entries = Entry::getEntries($request);
        foreach ($entries as $entry) {
            $data = $entry->getMessagings();
            foreach ($data as $messaging) {
                $shop = Shop::where('page_id', $messaging->getRecipientId())->first();
                dispatch(new BotHandler($messaging, $shop->page_access_token));
            }

            $data = $entry->getChanges();
            $page_id = $entry->getId();
            $shop = Shop::where('page_id', $page_id)->first();
            $auto_reply = AutoReply::where('shop_id', $shop->id)->get();

            foreach ($data as $changes) {
                if ($auto_reply->contains('post_id', $changes->getPostId())) {
                    if ($changes->getItem() == 'comment' && $changes->getVerb() == 'add') {
                        dispatch(new AutoReplyHandler($changes, $shop->page_access_token, $page_id));
                    }
                }
            }
        }
        return json_encode(response());
    }

    public function showHome()
    {
        echo 'home';
    }
}
