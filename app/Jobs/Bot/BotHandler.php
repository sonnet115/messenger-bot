<?php

namespace App\Jobs\Bot;

use App\Bot\Bot;
use App\Bot\Webhook\Messaging;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BotHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function handle()
    {
        if ($this->messaging->getType() == "message") {
            $bot = new Bot($this->messaging, "message");
            $bot->reply();
        }

        if ($this->messaging->getType() == "postback") {
            $bot = new Bot($this->messaging, "postback");
            $bot->reply();
        }
    }

}
