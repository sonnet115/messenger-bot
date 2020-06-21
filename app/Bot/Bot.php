<?php

namespace App\Bot;

use App\Bot\Webhook\Messaging;

class Bot
{
    private $messaging;
    private $type;
    private $recipientId;
    private $senderID;
    private $page_token;

    public function __construct(Messaging $messaging, $type, $page_token)
    {
        $this->messaging = $messaging;
        $this->type = $type;
        $this->recipientId = $this->messaging->getSenderId();//User ID
        $this->senderID = $this->messaging->getRecipientId();//App ID
        $this->page_token = $page_token;//page token
    }

    public function reply()
    {
        $data_handler = new DataHandler($this->recipientId, $this->senderID, $this->page_token);
        $data_handler->storeUserInfo();

        if ($this->type == "message") {
            $user_response = $this->messaging->getMessage()->getQuickReply();
        } else {
            $user_response = $this->messaging->getPostback()->getPayload();
        }

        $decision_maker = new DecisionMaker($user_response, $this->recipientId, $this->senderID, $this->page_token);
        $decision_maker->preparedResponses();
    }
}
