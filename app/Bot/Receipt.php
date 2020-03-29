<?php

namespace App\Bot;

class Receipt
{
    private $recipientId;
    private $placed_order_data;

    public function __construct($recipientId, $placed_order_data)
    {
        $this->recipientId = $recipientId;
        $this->placed_order_data = $placed_order_data;
    }

    public function sendReceipt()
    {
        return [
            "recipient" => [
                "id" => $this->recipientId
            ],
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "receipt",
                        "recipient_name" => $this->placed_order_data[0]->customers->first_name . ", " . $this->placed_order_data[0]->customers->last_name . " Mobile: " . $this->placed_order_data[0]->customers->contact,
                        "order_number" => $this->placed_order_data[0]->order_code,
                        "currency" => "BDT",
                        "payment_method" => "Cash on Delivery",
                        "order_url" => "http://petersapparel.parseapp.com/order?order_id=123456",
                        "timestamp" => strtotime($this->placed_order_data[0]->created_at),
                        "address" => $this->address(),
                        "summary" => $this->summary(),
                        "elements" => $this->products()
                    ]
                ]
            ]
        ];
    }

    public function address()
    {
        return [
            "street_1" => $this->placed_order_data[0]->customers->shipping_address,
            "street_2" => "",
            "city" => "Dhaka",
            "postal_code" => "1207",
            "state" => "Dhaka",
            "country" => "BD"
        ];
    }

    public function summary()
    {
        $subtotal = 0;
        foreach ($this->placed_order_data as $d) {
            $subtotal = $subtotal + $d->subtotal;
        }
        return [
            "subtotal" => $subtotal,
            "shipping_cost" => 60,
            "total_cost" => $subtotal + 60
        ];
    }

    public function products()
    {
        $p = array();
        foreach ($this->placed_order_data as $d) {
            array_push($p, [
                "title" => $d->products->name,
                "subtitle" => "Product_Code:" . $d->products->code,
                "quantity" => $d->product_qty,
                "price" => $d->product_price,
                "currency" => "BDT",
                "image_url" => "http://134.209.108.173/uploads/C05V0144_mega_handover.png"
            ]);
        }

        return json_encode($p);
    }
}
