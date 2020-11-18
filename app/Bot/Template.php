<?php

namespace App\Bot;

class Template
{
    private $recipientId;
    private $app_id;
    private $base_url;

    public function __construct($recipientId, $app_id)
    {
        $this->recipientId = $recipientId;
        $this->app_id = $app_id;
        $this->base_url = env('APP_URL');
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
                                "url" => $this->base_url . "bot/" . $this->app_id . "/product-search-form/" . $this->recipientId,
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
                                "url" => $this->base_url . "bot/" . $this->app_id . "/product-search-form/" . $this->recipientId,
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
                                "url" => $this->base_url . "bot/" . $this->app_id . "/cart/" . $this->recipientId,
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
                                "url" => $this->base_url . "bot/" . $this->app_id . "/track-order-form/" . $this->recipientId,
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
