<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Config for rekognition service
    |--------------------------------------------------------------------------
    */
    'rekognition' => [
        'key' => env('AWS_REKOGNITION_KEY'),
        'secret' => env('AWS_REKOGNITION_SECRET'),
    ]
];
