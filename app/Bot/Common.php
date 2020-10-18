<?php


namespace App\Bot;


use Illuminate\Support\Facades\Log;

class Common
{
    private $page_token;

    public function __construct($page_token)
    {
        $this->page_token = $page_token;
    }

    public function sendAPIRequest($messageData)
    {
      try{
          $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->page_token);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_HEADER, false);
          curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
          $response = curl_exec($ch);

//          Log::channel('page_add')->info('bot response: ' . json_encode($messageData).PHP_EOL);
//          Log::channel('page_add')->info('bot response: ' . json_encode($response).PHP_EOL);
      }catch (\Exception $e){
          dd($e);
      }
    }

    public function sendHandoverRequest($messageData)
    {
        $ch = curl_init('https://graph.facebook.com/v2.6/me/pass_thread_control?access_token=' . $this->page_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        $response = curl_exec($ch);

        Log::channel('page_add')->info('handover request: ' . json_encode($messageData).PHP_EOL);
        Log::channel('page_add')->info('handover response: ' . json_encode($response).PHP_EOL);
    }
}
