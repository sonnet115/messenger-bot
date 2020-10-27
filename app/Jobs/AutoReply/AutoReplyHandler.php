<?php

namespace App\Jobs\AutoReply;

use App\AutoReply\Webhook\Changes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoReplyHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $changes;
    private $page_token;

    public function __construct(Changes $changes, $page_token)
    {
        $this->changes = $changes;
        $this->page_token = $page_token;
    }

    public function handle()
    {
        var_dump($this->changes->getVerb());
        var_dump($this->changes->getCommentId());
    }

}
