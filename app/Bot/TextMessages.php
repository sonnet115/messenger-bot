<?php

namespace App\Bot;

class TextMessages
{
    private $recipientId;

    public function __construct($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function sendTextMessage($messageText)
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "text" => $messageText
            ]
        ];
    }
}
