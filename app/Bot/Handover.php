<?php

namespace App\Bot;

class Handover
{
    private $recipientId;

    public function __construct($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function handoverControlToHumanAgent()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "target_app_id" => 263902037430900,
            "metadata" => "String to pass to secondary receiver app"
        ];
    }
}
