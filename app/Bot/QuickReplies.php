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
                        "title" => "Product Enquiry",
                        "payload" => "PRODUCT_ENQUIRY",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Order Product",
                        "payload" => "ORDER_PRODUCT",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Track Order",
                        "payload" => "TRACK_ORDER",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Talk to Agent",
                        "payload" => "TALK_TO_AGENT",
                    ],
                ],

            ]
        ];
    }
}
