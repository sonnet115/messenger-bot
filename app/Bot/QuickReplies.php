<?php

namespace App\Bot;

class QuickReplies
{
    private $recipientId;

    public function __construct($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function basicOptions()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "text" => "Choose an option",
                "quick_replies" => [
                    [
                        "content_type" => "text",
                        "title" => "Products",
                        "payload" => "PRODUCT_SEARCH",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "View Cart",
                        "payload" => "VIEW_CART"
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Track Orders",
                        "payload" => "TRACK_ORDER",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Help!",
                        "payload" => "TALK_TO_AGENT",
                    ],
                ],

            ]
        ];
    }
}
