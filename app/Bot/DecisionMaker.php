<?php

namespace App\Bot;

class DecisionMaker
{
    private $user_response;
    private $recipientId;
    private $common;
    private $handover;
    private $text_message;

    public function __construct($user_response, $recipientId)
    {
        $this->user_response = $user_response;
        $this->recipientId = $recipientId;

        $this->common = new Common();
        $this->handover = new Handover($recipientId);
        $this->text_message = new TextMessages($recipientId);
    }

    public function preparedResponses()
    {
        $this->sendMarkSeen();
        $this->sendSenderTyping();
        $this->fetchResponse();
    }

    private function fetchResponse()
    {
        switch ($this->user_response) {
            case "ORDER_PRODUCT":
                $this->sendTemplate("ORDER_PRODUCT");
                break;
            case "TRACK_ORDER":
                $this->sendTemplate("TRACK_ORDER");
                break;
            case "PRODUCT_ENQUIRY":
                $this->sendTemplate("PRODUCT_ENQUIRY");
                break;
            case "TALK_TO_AGENT":
                $this->sendHandover("An agent will contact you shortly. Please tell us what do you want to know.");
                break;
            case "CANCEL_ORDER":
                $this->sendHandover("An agent will contact you shortly.Please tell us your reason to cancel");
                break;
            case "GET_STARTED":
            default:
                $this->sendQuickReply();
                break;
        }
    }

    private function sendQuickReply()
    {
        $quick_replies = new QuickReplies($this->recipientId);
        $messageData = $quick_replies->basicOptions();
        $this->common->sendAPIRequest($messageData);
    }

    private function sendTemplate($template_type)
    {
        $form_template = new Template($this->recipientId);

        if ($template_type == "ORDER_PRODUCT") {
            $messageData = $form_template->orderFormTemplate();
        } else if ($template_type == "TRACK_ORDER") {
            $messageData = $form_template->trackOrderProductTemplate();
        } else if ($template_type == "PRODUCT_ENQUIRY") {
            $messageData = $form_template->productEnquiryTemplate();
        }

        $this->common->sendAPIRequest($messageData);
    }

    private function sendSenderTyping()
    {
        $messageData = [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "sender_action" => "typing_on",
        ];
        $this->common->sendAPIRequest($messageData);
    }

    private function sendMarkSeen()
    {
        $messageData = [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "sender_action" => "mark_seen",
        ];
        $this->common->sendAPIRequest($messageData);
    }

    private function sendHandover($message)
    {
        $this->common->sendHandoverRequest($this->handover->handoverControlToHumanAgent());
        $this->common->sendAPIRequest($this->text_message->sendTextMessage($message));
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
