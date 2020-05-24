<?php

namespace App\Http\Controllers;

use App\Bot\Webhook\Entry;
use App\Jobs\BotHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BotController extends Controller
{
    public function receive(Request $request)
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
