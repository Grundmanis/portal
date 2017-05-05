<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
        'client_id' => '8e911989a51bfae4aa20',
        'client_secret' => 'ece7279b04a52045a65365b96e64eaeaecd4d9ec',
        'redirect' => 'http://127.0.0.1:8000/login/github/callback',
    ],
    'facebook' => [
        'client_id' => '639217382931474',
        'client_secret' => '2983e7a9a87ec5ce68f65a06db6ed766',
        'redirect' => 'http://127.0.0.1:8000/login/facebook/callback',
    ],
    'twitter' => [
        'client_id' => 'IntMIFEdDTe9oqV4vrMJmp5mZ',
        'client_secret' => 'duYGvhpOy6ZsMmCm3meBRMIeCPJuDbnvWmZdvlmk0OLEkI2Dew',
        'redirect' => 'http://127.0.0.1:8000/login/twitter/callback',
    ],

];
