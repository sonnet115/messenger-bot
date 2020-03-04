<?php

namespace App\Http\Controllers;

use App\Bot\Webhook\Entry;
use App\Jobs\BotHandler;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
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
