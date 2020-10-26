<?php

namespace App\AutoReply\Webhook;


class Changes
{
    public static $TYPE_MESSAGE = "message";

    private $senderId;
    private $post_id;
    private $item;
    private $verb;

    public function __construct(array $data)
    {
        $this->senderId = $data['value']["from"]["id"];
        $this->post_id = $data['value']["post_id"];
        $this->item = $data['value']["item"];
        $this->verb = $data['value']["verb"];
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getVerb()
    {
        return $this->verb;
    }
}
