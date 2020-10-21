<?php

return [
    'user_model' => env('MARKETPLACEFUL_USER_MODEL', App\Models\User::class),

    /**
     * CURRENCY
     *
     * Define your marketplace currency
     */
    'currency' => [
        'name' => 'Dollar',
        'iso_code' => 'USD', // Make sure to use ISO_4217 https://en.wikipedia.org/wiki/ISO_4217
        'symbol' => '$',
        'delimiter' => '.',
    ],
];
