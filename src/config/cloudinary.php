<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 12/02/2015
 * Time: 22:17
 */


return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary API configuration
    |--------------------------------------------------------------------------
    |
    | Before using Cloudinary you need to register and get some detail
    | to fill in below, please visit cloudinary.com.
    |
    */

    'cloudName'  => env('CLOUDINARY_CLOUD_NAME', ''),
    'baseUrl'    => '',
    'secureUrl'  => '',
    'apiBaseUrl' => '',
    'apiKey'     => env('CLOUDINARY_API_KEY', ''),
    'apiSecret'  => env('CLOUDINARY_API_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | Default image scaling to show.
    |--------------------------------------------------------------------------
    |
    | If you not pass options parameter to Cloudy::show the default
    | will be replaced.
    |
    */

    'scaling'    => [
        'format' => 'png',
        'width'  => 150,
        'height' => 150,
        'crop'   => 'fit',
        'effect' => null
    ]

];