<?php

include_once __DIR__."/autoload.php";

use config\request;

request::config([
    'app'               => 'resource/config/app.php',
    'key'               => 'AnoOnion',
    'session'           => 'true',
    'custom_request'    => 'halo',

    'db' => [
        'url'   => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'db'    => 'db_telegram'
    ],

    'telegram' => [
        'key' => '23214619846397409327940'
    ]
]);
