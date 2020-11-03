<?php

namespace App\Jobs\AutoReply;

use App\AutoReply\Webhook\Changes;
use App\Bot\AutoReplyTemplate;
use App\Bot\Common;
use App\Bot\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoReplyHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $changes;
    private $comment_id;
    private $post_id;
    private $page_access_token;

    public function __construct(Changes $changes, $page_access_token)
    {
        $this->changes = $changes;
        $this->comment_id = $changes->getCommentId();
        $this->post_id = $changes->getPostId();
        $this->page_access_token = $page_access_token;
    }

    public function handle()
    {
        $form_template = new AutoReplyTemplate($this->comment_id, $this->post_id);
        $common = new Common($this->page_access_token);
        var_dump($form_template->productsDetailsTemplate());
        $common->sendAPIRequest($form_template->productsDetailsTemplate());
        /*  var_dump($this->changes->getVerb());
          var_dump($this->changes->getCommentId());*/
        var_dump($this->comment_id);
    }

}
