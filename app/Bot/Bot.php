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
        $this->sendMarkSeen($id);
        $this->sendSenderTyping($id);
        $this->sendTemplate($id);
    }

    private function sendQuickReply($recipientId)
    {
        $quick_replies = new QuickReplies($recipientId);
        $messageData = $quick_replies->basicOptions();
        $this->apiRequest($messageData);
    }

    private function sendTemplate($recipientId)
    {
        $form_template = new Template($recipientId);
        $messageData = $form_template->orderFormTemplate();
        $this->apiRequest($messageData);
    }

    private function sendSenderTyping($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "sender_action" => "typing_on",
        ];
        $this->apiRequest($messageData);
    }

    private function sendMarkSeen($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "sender_action" => "mark_seen",
        ];
        $this->apiRequest($messageData);
    }

    private function apiRequest($messageData)
    {
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    }

    private function setPersistentMenu()
    {
        $message_data = [
            "get_started" => [
                "payload" => "Get started"
            ],
            "persistent_menu" => [
                [
                    "locale" => "default",
                    "composer_input_disabled" => false,
                    "call_to_actions" => [
                        [
                            "type" => "postback",
                            "title" => "Product Enquiry",
                            "payload" => "PRODUCT_ENQUIERY"
                        ],
                        [
                            "type" => "postback",
                            "title" => "Track Order",
                            "payload" => "ORDER_TRACK"
                        ]
                    ]
                ]
            ]
        ];

        $ch = curl_init('https://graph.facebook.com/v6.0/me/messenger_profile?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message_data));
        curl_exec($ch);
    }

    private function customUserSettings($recipientId)
    {
        $messageData = [
            "psid" => $recipientId,
            "persistent_menu" => [
                [
                    "locale" => "default",
                    "composer_input_disabled" => true,
                    "call_to_actions" => [
                        [
                            "type" => "postback",
                            "title" => "Talk to an agent",
                            "payload" => "CARE_HELP"
                        ],
                        [
                            "type" => "postback",
                            "title" => "Outfit suggestions",
                            "payload" => "CURATION"
                        ],
                        [
                            "type" => "web_url",
                            "title" => "Shop now",
                            "url" => "https://www.originalcoastclothing.com/",
                            "webview_height_ratio" => "full"
                        ]
                    ]
                ]
            ]
        ];
        $ch = curl_init('https://graph.facebook.com/v6.0/me/custom_user_settings?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    }
}
