<?php

namespace App\Bot;

class Template
{
    private $recipientId;

    public function __construct($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function orderProductTemplate()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => "Click the button",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "bot/product-search-form/" . $this->recipientId,
                                "title" => "Order Product",
                                "messenger_extensions" => 'true',
                                "webview_height_ratio" => "tall",
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function productSearchTemplate()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => "Click the button",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "bot/product-search-form/" . $this->recipientId,
                                "title" => "Search Product",
                                "messenger_extensions" => 'true',
                                "webview_height_ratio" => "tall",
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function viewCartTemplate()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => "Click the button",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "bot/cart/" . $this->recipientId,
                                "title" => "View Cart",
                                "messenger_extensions" => 'true',
                                "webview_height_ratio" => "tall",
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function trackOrderProductTemplate()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => "Click the button",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "bot/track-order-form/" . $this->recipientId,
                                "title" => "Track Order",
                                "messenger_extensions" => 'true',
                                "webview_height_ratio" => "tall",
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}
