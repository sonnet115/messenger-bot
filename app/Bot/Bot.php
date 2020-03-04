<?php

namespace App\Bot;

use App\Bot\Webhook\Messaging;

class Bot
{
    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function reply()
    {
        $id = $this->messaging->getSenderId();
        $text = $this->messaging->getMessage()->getText();
        if ($text == "Hello") {
            $message = "Hi, How can I help you.";
        } else {
            $message = "Sorry, Cant understand you. I am a new born bot";
        }
        $this->sendMarkSeen($id);
        $this->sendSenderTyping($id);
        $this->sendTextMessage($id, $message);
    }

    private function sendSenderTyping($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "sender_action" => "typing_on",
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

    }

    private function sendMarkSeen($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "sender_action" => "mark_seen",
        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

    }

    private function sendTextMessage($recipientId, $messageText)
    {
//        $messageData = [
//            "recipient" => [
//                "id" => $recipientId
//            ],
//            "message" => [
//                "text" => "Please choose one.",
//                "quick_replies" => [
//                    [
//                        "content_type" => "text",
//                        "title" => "Option 1",
//                        "payload" => "option_1",
//                    ],
//                    [
//                        "content_type" => "text",
//                        "title" => "Option 2",
//                        "payload" => "option_2",
//                    ]
//                ],
//
//            ]
//        ];

        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "image",
                    "payload" => [
                        "url" => "http://bpgift.ciphershack.com/uploads/C01M0003_mega_opened.png",
                        "is_reusable" => true
                    ]
                ]
            ],
//            "messaging_type" => "MESSAGE_TAG",
//            "tag" => "POST_PURCHASE_UPDATE"
        ];

//        $messageData = [
//            "recipient" => [
//                "id" => $recipientId
//            ],
//            "message" => [
//                "text" => "Update for delivery"
//            ],
//            "messaging_type" => "MESSAGE_TAG",
//            "tag" => "POST_PURCHASE_UPDATE"
//        ];
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

    }
}
