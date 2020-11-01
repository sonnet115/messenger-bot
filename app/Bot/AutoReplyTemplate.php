<?php

namespace App\Bot;

class AutoReplyTemplate
{
    private $comment_id;
    private $post_id;

    public function __construct($comment_id, $post_id)
    {
        $this->comment_id = $comment_id;
        $this->post_id = $post_id;
    }

    public function productsDetailsTemplate()
    {
        return [
            "recipient" => [
                "comment_id" => $this->comment_id
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => "Please click the button to see details!",
                        "buttons" => [
                            [
                                "type" => "web_url",
                                "url" => env("APP_URL") . "bot/posts/" . $this->post_id,
                                "title" => "View Details",
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
