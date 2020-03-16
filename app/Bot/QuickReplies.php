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
                "text" => "Please Choose an option",
                "quick_replies" => [
                    [
                        "content_type" => "text",
                        "title" => "Order Product",
                        "payload" => "order_product",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Product Enquiry",
                        "payload" => "product_enquiry",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Track Order",
                        "payload" => "track_order",
                    ],
                    [
                        "content_type" => "text",
                        "title" => "Chat with Agent",
                        "payload" => "chat_agent",
                    ],
                ],

            ]
        ];
    }
}
