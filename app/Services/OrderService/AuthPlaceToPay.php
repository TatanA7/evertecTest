<?php

    namespace App\Services\OrderService;

    use Dnetix\Redirection\PlacetoPay;

    trait AuthPlaceToPay {
            public function AuthPlaceToPay()
            {
                return
                    new PlacetoPay([
                        'login' => env('PLACETOPAY_LOGIN', '6dd490faf9cb87a9862245da41170ff2'),
                        'tranKey' => env('PLACETOPAY_TRANKEY','024h1IlD'),
                        'url' => env('PLACETOPAY_AUTH_URL','https://dev.placetopay.com/redirection/'),
                        'rest' => [
                            'timeout' => 45, // (optional) 15 by default
                            'connect_timeout' => 30, // (optional) 5 by default
                        ]
                    ]);
            }

        }
