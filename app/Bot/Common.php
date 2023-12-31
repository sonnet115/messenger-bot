<?php


namespace App\Bot;


class Common
{
    private $page_token;

    public function __construct($page_token)
    {
        $this->page_token = $page_token;
    }
    public function sendAPIRequest($messageData)
    {
        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->page_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    }

    public function sendHandoverRequest($messageData)
    {
        $ch = curl_init('https://graph.facebook.com/v2.6/me/pass_thread_control?access_token=' . $this->page_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);
    }
}
