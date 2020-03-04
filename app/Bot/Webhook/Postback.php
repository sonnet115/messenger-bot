<?php

namespace App\Bot\Webhook;


class Postback
{
    private $title;
    private $payload;

    public function __construct(array $data)
    {
        $this->title = isset($data["title"]) ? $data["title"] : "";
        $this->payload = isset($data["payload"]) ? $data["payload"] : "";
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPayload()
    {
        return $this->payload;
    }

}
