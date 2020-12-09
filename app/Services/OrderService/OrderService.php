<?php

    namespace App\Services\OrderService;

use App\Models\Article;
use App\Models\Customer;
use App\Models\PayOrder;
use App\Services\OrderService\AuthPlaceToPay;

    class OrderService {

        use AuthPlaceToPay;

        public function generateOrder($data)
        {
            $article  = Article::find($data['article_id']);
            
            $data['article']     = $article->article;
            $data['price']       = $article->price;

            $customer            = Customer::createCustom($data);
            $data['customer_id'] = $customer->id;

            $order               = PayOrder::createOrder($data);
            $data['order_id']    = $order->id;

            return $data;
        }

        public function dataMapping($orderData)
        {
            return 
                $request = [
                    "locale" => "es_CO",
                    "payer"  => [
                        "name"          => $orderData->name,
                        "surname"       => $orderData->last_name,
                        "documentType" =>  $orderData->document_type,
                        'document'      => $orderData->document,
                        "email"         => $orderData->email,
                        "mobile"        => $orderData->mobile_phone,
                    ],
                    "payment" => [
                        "reference"     => 'Compra de '.$orderData->article,
                        "description"   => "Iusto sit et voluptatem.",
                        "amount" => [
                            "currency"  => "COP",
                            "total"     => $orderData->price
                        ],
                        "items" => [
                            [
                                "sku"       => 10000,
                                "name"      => $orderData->article,
                                "category"  => "physical",
                                "qty"       => 1,
                                "price"     => $orderData->price * 0.81,
                                "tax"       => $orderData->price*0.19
                            ]
                        ],
                        "shipping" => [
                            "name"          => $orderData->name,
                            "email"         => $orderData->email,
                            "documentType"  => $orderData->document_type,
                            "document"      => $orderData->document,
                            "mobile"        => $orderData->mobile_phone,
                            "address"       => [
                                "street"        => $orderData->address,
                                "city"          => $orderData->city,
                                "state"         => $orderData->state,
                                "postalCode"    => "46292",
                                "country"       => "CO",
                                "phone"         => $orderData->mobile_phone
                            ]
                        ],
                        "allowPartial" => false
                    ],
                    "expiration"    => date('c', strtotime('+6 minutes')),
                    "ipAddress"     => "127.0.0.1",
                    "userAgent"     => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36",
                    "returnUrl"     => url("order/$orderData->order_id"),
                    "cancelUrl"     => url("order/$orderData->order_id"),
                    "paymentMethod" => null
            ];
        }
    }
