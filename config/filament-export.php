<?php

return [
    'expires_in_minute' => 30,

    'disk_name' => 's3',

    'http' => [
        'route' => [
            'name' => 'filament-export.download',
            'path' => 'admin/export/download',
            'middleware' => []
        ]
    ]

];
