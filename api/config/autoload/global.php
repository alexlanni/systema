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
            'session_ttl' => 3600,
            'private_key' => __DIR__ . '/../../data/.jwt-key',
            'map' => [
                'Systema\\V1' => 'SystemaAuth',
                'SystemaAuth\\V1' => 'SystemaAuth',
            ],
        ],
    ],
];
