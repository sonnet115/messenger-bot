<?php

namespace App\Bot;

class Template
{
    private $recipientId;

    public function __construct($recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function orderFormTemplate()
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
                        "text" => "Fill the form",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "order-form/" . $this->recipientId,
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

    public function productEnquiryTemplate()
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
                                "url" => env("APP_URL") . "product-search-form/" . $this->recipientId,
                                "title" => "Product Enquiry",
                                "messenger_extensions" => 'true',
                                "webview_height_ratio" => "tall",
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function preOrderProductTemplate()
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
                                "url" => env("APP_URL"),
                                "title" => "Pre Order",
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
                                "url" => env("APP_URL") . "track-order-form",
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
