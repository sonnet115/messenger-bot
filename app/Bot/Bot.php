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
        $this->sendReceipt($id);
//        $this->disableComposer($id);
        $this->enableComposer($id);

//        if($this->messaging->getMessage()->getText() == "enable")
//            $this->enableComposer($id);
//        if($this->messaging->getMessage()->getText() == "disable")
//            $this->disableComposer($id);
    }

    private function disableComposer($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
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

        $ch = curl_init('https://graph.facebook.com/v2.6/me/messenger_profile?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

    }

    private function enableComposer($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "persistent_menu" => [
                [
                    "locale" => "default",
                    "composer_input_disabled" => false,
                ]
            ]
        ];

        $ch = curl_init('https://graph.facebook.com/v2.6/me/messenger_profile?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

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

    private function sendTemplate($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "generic",
                        "elements" => [
                            [
                                "title" => "Welcome!",
                                "image_url" => "http://bpgift.ciphershack.com/uploads/%22C01M0003%22_%22opened%22.png",
                                "subtitle" => "We have the right hat for everyone.",
                                "default_action" => [
                                    "type" => "web_url",
                                    "url" => "http://bpgift.ciphershack.com",
                                    "webview_height_ratio" => "tall",
                                ],
                                "buttons" => [
                                    [
                                        "type" => "web_url",
                                        "url" => "https://petersfancybrownhats.com",
                                        "title" => "View Website"
                                    ], [
                                        "type" => "postback",
                                        "title" => "Start Chatting",
                                        "payload" => "DEVELOPER_DEFINED_PAYLOAD"
                                    ]
                                ]
                            ],

                            [
                                "title" => "Welcome!",
                                "image_url" => "http://bpgift.ciphershack.com/uploads/%22C01M0003%22_%22opened%22.png",
                                "subtitle" => "We have the right hat for everyone.",
                                "default_action" => [
                                    "type" => "web_url",
                                    "url" => "http://bpgift.ciphershack.com",
                                    "webview_height_ratio" => "tall",
                                ],
                                "buttons" => [
                                    [
                                        "type" => "web_url",
                                        "url" => "https://petersfancybrownhats.com",
                                        "title" => "View Website"
                                    ], [
                                        "type" => "postback",
                                        "title" => "Start Chatting",
                                        "payload" => "DEVELOPER_DEFINED_PAYLOAD"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("PAGE_ACCESS_TOKEN"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
        curl_exec($ch);

    }

    private function sendReceipt($recipientId)
    {
        $messageData = [
            "recipient" => [
                "id" => $recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "receipt",
                        "recipient_name" => "Stephane Crozatier",
                        "order_number" => "12345678902",
                        "currency" => "USD",
                        "payment_method" => "Visa 2345",
                        "order_url" => "http://petersapparel.parseapp.com/order?order_id=123456",
                        "timestamp" => "1428444852",
                        "address" => [
                            "street_1" => "1 Hacker Way",
                            "street_2" => "",
                            "city" => "Menlo Park",
                            "postal_code" => "94025",
                            "state" => "CA",
                            "country" => "US"
                        ],
                        "summary" => [
                            "subtotal" => 75.00,
                            "shipping_cost" => 4.95,
                            "total_tax" => 6.19,
                            "total_cost" => 56.14
                        ],
                        "adjustments" => [
                            [
                                "name" => "New Customer Discount",
                                "amount" => 20
                            ],
                            [
                                "name" => "$10 Off Coupon",
                                "amount" => 10
                            ]
                        ],
                        "elements" => [
                            [
                                "title" => "Classic White T-Shirt",
                                "subtitle" => "100% Soft and Luxurious Cotton",
                                "quantity" => 2,
                                "price" => 50,
                                "currency" => "USD",
                                "image_url" => "http://petersapparel.parseapp.com/img/whiteshirt.png"
                            ],
                            [
                                "title" => "Classic Gray T-Shirt",
                                "subtitle" => "100% Soft and Luxurious Cotton",
                                "quantity" => 1,
                                "price" => 25,
                                "currency" => "USD",
                                "image_url" => "http://petersapparel.parseapp.com/img/grayshirt.png"
                            ]
                        ]
                    ]
                ]
            ]
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
