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
                        "template_type" => "generic",
                        "elements" => [
                            [
                                "title" => "Order Form",
                                "image_url" => "http://bpgift.ciphershack.com/uploads/C22P0005_opened.jpg",
                                "subtitle" => "Please fill up all information!",
                                "default_action" => [
                                    "type" => "web_url",
                                    "url" => env("TUNNEL"),
                                    "webview_height_ratio" => "tall",
                                ],
                                "buttons" => [
                                    [
                                        "type" => "web_url",
                                        "title" => "Place Order",
                                        "url" => env("TUNNEL"),
                                        "messenger_extensions" => 'true',
                                        "webview_height_ratio" => 'full',
                                        "fallback_url" => env("TUNNEL")
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function testTemplate()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "media",
                        "elements" => [
                            [
                                "media_type" => "image",
                                "url" => "https://www.facebook.com/photo.php?fbid=601112986766364&set=a.247113122166354&type=3&theater",
                                "buttons" => [
                                    [
                                        "type" => "web_url",
                                        "url" => "http://bpgift.ciphershack.com/",
                                        "title" => "View Website",
                                        "messenger_extensions" => "true"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}
