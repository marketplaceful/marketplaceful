<?php

use Marketplaceful\Features;

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

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of the Marketplaceful features are optional. You may disable the features
    | by removing them from this array. You're free to only remove some of
    | these features or you can even remove all of these if you need to.
    |
    */

    'features' => [
        Features::authentication(),
    ],
];
