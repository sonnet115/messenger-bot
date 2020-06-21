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
    private $page_token;

    public function __construct(Messaging $messaging, $page_token)
    {
        $this->messaging = $messaging;
        $this->page_token = $page_token;
    }

    public function handle()
    {
        if ($this->messaging->getType() == "message") {
            $bot = new Bot($this->messaging, "message", $this->page_token);
            $bot->reply();
        }

        if ($this->messaging->getType() == "postback") {
            $bot = new Bot($this->messaging, "postback", $this->page_token);
            $bot->reply();
        }
    }

}
