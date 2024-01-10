<?php

return [
    'temporary_files' => [

        'disk' => env('FILESYSTEM_DISK', 's3'),

        'base_directory' => 'filament-export',
    ],

    'user_timezone_field' => 'timezone',

    'expires_in_minute' => 60,

//    'http' => [
//        'route' => [
//            'name' => 'filament-export.download',
//            'path' => 'admin/export/download',
//            'middleware' => []
//        ]
//    ]

];
