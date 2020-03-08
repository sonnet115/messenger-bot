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
                                    "url" => "http://bpgift.ciphershack.com",
                                    "webview_height_ratio" => "tall",
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

}
