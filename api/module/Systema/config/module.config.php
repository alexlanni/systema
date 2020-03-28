<?php
return [
    'service_manager' => [
        'factories' => [
            \Systema\Service\SystemaService::class => \Systema\Service\SystemaServiceFacotry::class,
            \Systema\V1\Rest\Ping\PingResource::class => \Systema\V1\Rest\Ping\PingResourceFactory::class,
            \Systema\V1\Rest\LocalType\LocalTypeResource::class => \Systema\V1\Rest\LocalType\LocalTypeResourceFactory::class,
            \Systema\Authentication\AuthAdapter::class => \Systema\Authentication\AuthAdapterFactory::class,
            \Systema\Authorization\AuthorizationService::class =>\Systema\Authorization\AuthorizationServiceFactory::class,
        ],
        'delegators' => [
            \Laminas\ApiTools\MvcAuth\Authentication\DefaultAuthenticationListener::class => [
                \Systema\Authentication\AuthDelegatorFactory::class,
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'systema.rest.ping' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ping[/:ping_id]',
                    'defaults' => [
                        'controller' => 'Systema\\V1\\Rest\\Ping\\Controller',
                    ],
                ],
            ],
            'systema.rest.local-type' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/local-type[/:local_type_id]',
                    'defaults' => [
                        'controller' => 'Systema\\V1\\Rest\\LocalType\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'systema.rest.ping',
            1 => 'systema.rest.local-type',
        ],
    ],
    'api-tools-rest' => [
        'Systema\\V1\\Rest\\Ping\\Controller' => [
            'listener' => \Systema\V1\Rest\Ping\PingResource::class,
            'route_name' => 'systema.rest.ping',
            'route_identifier_name' => 'ping_id',
            'collection_name' => 'ping',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Systema\V1\Rest\Ping\PingEntity::class,
            'collection_class' => \Systema\V1\Rest\Ping\PingCollection::class,
            'service_name' => 'ping',
        ],
        'Systema\\V1\\Rest\\LocalType\\Controller' => [
            'listener' => \Systema\V1\Rest\LocalType\LocalTypeResource::class,
            'route_name' => 'systema.rest.local-type',
            'route_identifier_name' => 'local_type_id',
            'collection_name' => 'local_type',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Systema\V1\Rest\LocalType\LocalTypeEntity::class,
            'collection_class' => \Systema\V1\Rest\LocalType\LocalTypeCollection::class,
            'service_name' => 'LocalType',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Systema\\V1\\Rest\\Ping\\Controller' => 'HalJson',
            'Systema\\V1\\Rest\\LocalType\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Systema\\V1\\Rest\\Ping\\Controller' => [
                0 => 'application/vnd.systema.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Systema\\V1\\Rest\\LocalType\\Controller' => [
                0 => 'application/vnd.systema.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Systema\\V1\\Rest\\Ping\\Controller' => [
                0 => 'application/vnd.systema.v1+json',
                1 => 'application/json',
            ],
            'Systema\\V1\\Rest\\LocalType\\Controller' => [
                0 => 'application/vnd.systema.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Systema\V1\Rest\Ping\PingEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema.rest.ping',
                'route_identifier_name' => 'ping_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \Systema\V1\Rest\Ping\PingCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema.rest.ping',
                'route_identifier_name' => 'ping_id',
                'is_collection' => true,
            ],
            \Systema\V1\Rest\LocalType\LocalTypeEntity::class => [
                'entity_identifier_name' => 'localTypeId',
                'route_name' => 'systema.rest.local-type',
                'route_identifier_name' => 'local_type_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \Systema\V1\Rest\LocalType\LocalTypeCollection::class => [
                'entity_identifier_name' => 'localTypeId',
                'route_name' => 'systema.rest.local-type',
                'route_identifier_name' => 'local_type_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authentication' => [
            'adapters' => [
                'SystemaAuth' => [
                    'adapter' => \Systema\Authentication\AuthAdapter::class,
                    'options' => [
                        //Da decidere
                    ],
                    ]
                ]
            ],
        'authorization' => [
            'Systema\\V1\\Rest\\LocalType\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
    'systema-auth' => [
        // Array associativo tra Entity (in risposta) e AssertionClass
        'owner-assertions' => [
            'default' => \Systema\Authorization\Assertion\AssertOwner::class,
            'collection-default' => \Systema\Authorization\Assertion\AssertCollectionOwner::class,
            \Systema\V1\Rest\LocalType\LocalTypeEntity::class =>
                \Systema\Authorization\Assertion\AssertGrantedEntity::class,
            \Systema\V1\Rest\LocalType\LocalTypeCollection::class =>
                \Systema\Authorization\Assertion\AssertGrantedCollection::class,
            \SystemaAuth\V1\Rest\Role\RoleCollection::class =>
                \Systema\Authorization\Assertion\AssertAdminsCollection::class,
        ]
    ],
];
