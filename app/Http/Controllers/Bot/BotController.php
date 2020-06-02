<?php

namespace App\Http\Controllers\Bot;

use App\Bot\Webhook\Entry;
use App\Http\Controllers\Controller;
use App\Jobs\Bot\BotHandler;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function verifyWebhook(Request $request)
    {
        $entries = Entry::getEntries($request);
        foreach ($entries as $entry) {
            $messagings = $entry->getMessagings();
            foreach ($messagings as $messaging) {
                dispatch(new BotHandler($messaging));
            }
        }
        return json_encode(response());
    }
}
