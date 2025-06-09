<?php

return [
    'models' => [
        'user' => [
            'model' => 'App\\Models\\User',
            'mapping' => [
                'id' => 'uuid'
            ],
            'relations' => [
                'site' => 'App\\Models\\Site'
            ],
        ],
        'site' => [
            'model' => 'App\\Models\\Site',
            'mapping' => [],
            'relations' => [
                'client' =>  'App\\Models\\Client'
            ],
        ],
        'App\\Models\\Client' => [
            'mapping' => [],
        ],
    ],
];