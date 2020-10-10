<?php

namespace App\Bot;

use App\ProductImage;

class Receipt
{
    private $recipientId;
    private $placed_order_data;
    private $total_discount;

    public function __construct($recipientId, $placed_order_data)
    {
        $this->recipientId = $recipientId;
        $this->placed_order_data = $placed_order_data;
        $this->total_discount = 0;
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
                        "recipient_name" => $this->placed_order_data->customer_name . ", Mobile: " . $this->placed_order_data->contact,
                        "order_number" => $this->placed_order_data->code,
                        "currency" => "BDT",
                        "payment_method" => "Cash on Delivery",
                        "order_url" => "http://petersapparel.parseapp.com/order?order_id=123456",
                        "timestamp" => strtotime($this->placed_order_data->created_at),
                        "address" => $this->address(),
                        "summary" => $this->summary(),
                        "adjustments" => $this->discount(),
                        "elements" => $this->products()
                    ]
                ]
            ]
        ];
    }

    public function address()
    {
        return [
            "street_1" => $this->placed_order_data->shipping_address,
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
        $this->total_discount = 0;

        foreach ($this->placed_order_data->ordered_products as $product) {
            $subtotal = $subtotal + ($product->pivot->quantity * $product->pivot->price);
            $this->total_discount = $this->total_discount + $product->pivot->discount;
        }
        return [
            "subtotal" => $subtotal,
            "shipping_cost" => $this->placed_order_data->delivery_charge,
            "total_cost" => ($subtotal - $this->total_discount) + $this->placed_order_data->delivery_charge
        ];
    }

    public function discount()
    {
        $discount = array();
        if ($this->total_discount == 0) {
            return "";
        }

        array_push($discount, [
            "name" => "Discount",
            "amount" => (double)$this->total_discount,
        ]);

        return json_encode($discount);
    }

    public function products()
    {
        $products = array();
        foreach ($this->placed_order_data->ordered_products as $product) {
            $product_image = ProductImage::where('pid', $product->id)->first();
            $absolute_url = 'https://clients.howkar.com/images/products/' . $product_image->image_url;
            array_push($products, [
                "title" => $product->name,
                "subtitle" => "Product_Code:" . $product->code,
                "quantity" => $product->pivot->quantity,
                "price" => $product->pivot->price,
                "currency" => "BDT",
                "image_url" => $absolute_url
            ]);
        }

        return json_encode($products);
    }
}
