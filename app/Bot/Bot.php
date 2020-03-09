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
        $this->sendQuickReply($id);

        $payload = $this->messaging->getMessage()->getQuickReply();
        if ($payload['payload'] == "order_product") {
            $this->sendTemplate($id);
        }
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
}
