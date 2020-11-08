<?php

namespace App\Jobs\AutoReply;

use App\AutoReply;
use App\AutoReply\Webhook\Changes;
use App\Bot\AutoReplyTemplate;
use App\Bot\Common;
use App\Bot\DataHandler;
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
    private $page_id;
    private $post_id;
    private $recipient_id;
    private $page_access_token;

    public function __construct(Changes $changes, $page_access_token, $page_id)
    {
        $this->changes = $changes;
        $this->comment_id = $changes->getCommentId();
        $this->post_id = $changes->getPostId();
        $this->recipient_id = $changes->getSenderId();
        $this->page_access_token = $page_access_token;
        $this->page_id = $page_id;
    }

    public function handle()
    {
        $data_handler = new DataHandler($this->recipient_id, $this->page_id, $this->page_access_token);
        $data_handler->storeUserInfo();

        $form_template = new AutoReplyTemplate($this->comment_id, $this->post_id, $this->recipient_id, $this->page_id);
        $common = new Common($this->page_access_token);
        $common->sendAPIRequest($form_template->productsDetailsTemplate());

//        $auto_reply = AutoReply::where('shop_id', $this->page_id)->get();
//        var_dump($auto_reply->contains('post_id', '304733696848773_678959172759555'));

        /*var_dump($form_template->productsDetailsTemplate());
        var_dump($this->changes->getVerb());
        var_dump($this->changes->getCommentId());
        var_dump($this->comment_id);*/
    }

}
