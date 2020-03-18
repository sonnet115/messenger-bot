<?php

namespace App\Bot;

use App\Bot\Webhook\Messaging;

class Bot
{
    private $messaging;
    private $type;
    private $recipientId;

    public function __construct(Messaging $messaging, $type)
    {
        $this->messaging = $messaging;
        $this->type = $type;
        $this->recipientId = $this->messaging->getSenderId();
    }

    public function reply()
    {
        $data_handler = new DataHandler($this->recipientId);
        $data_handler->storeUserInfo();

        if ($this->type == "message") {
            $user_response = $this->messaging->getMessage()->getQuickReply();
        } else {
            $user_response = $this->messaging->getPostback()->getPayload();
        }

        $decision_maker = new DecisionMaker($user_response, $this->recipientId);
        $decision_maker->preparedResponses();
    }
}
