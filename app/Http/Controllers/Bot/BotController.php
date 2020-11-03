<?php

namespace App\Http\Controllers\Bot;

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

            foreach ($data as $changes) {
                if ($changes->getPostId() == '304733696848773_672724670049672') {
                    if ($changes->getItem() == 'comment' && $changes->getVerb() == 'add') {
                        $shop = Shop::where('page_id', $page_id)->first();
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
