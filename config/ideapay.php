<?php

return [
    /**
     * Ideapay client id
     */
    'client_id' => env('IDEAPAY_CLIENT_ID', ''),

    /**
     * Ideapay client secret
     */
    'client_secret' => env('IDEAPAY_CLIENT_SECRET', ''),

    /**
     * Live url of Ideapay
     */
    'live' => env('IDEAPAY_LIVE')
];
