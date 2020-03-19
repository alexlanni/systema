<?php
return [
    'api-tools-content-negotiation' => [
        'selectors' => [],
    ],
    'db' => [
        'adapters' => [
            'dummy' => [],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'map' => [
                'Systema\\V1' => 'SystemaAuth',
                'SystemaAuth\\V1' => 'SystemaAuth',
            ],
        ],
    ],
];
