<?php
return [
    'service_manager' => [
        'factories' => [
            \SystemaAuth\V1\Rest\Login\LoginResource::class => \SystemaAuth\V1\Rest\Login\LoginResourceFactory::class,
            \SystemaAuth\V1\Rest\Role\RoleResource::class => \SystemaAuth\V1\Rest\Role\RoleResourceFactory::class,
            \SystemaAuth\V1\Rest\Resource\ResourceResource::class => \SystemaAuth\V1\Rest\Resource\ResourceResourceFactory::class,
            \SystemaAuth\V1\Rest\Session\SessionResource::class => \SystemaAuth\V1\Rest\Session\SessionResourceFactory::class,
            \SystemaAuth\V1\Rest\Address\AddressResource::class => \SystemaAuth\V1\Rest\Address\AddressResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'systema-auth.rest.login' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/login[/:login_id]',
                    'defaults' => [
                        'controller' => 'SystemaAuth\\V1\\Rest\\Login\\Controller',
                    ],
                ],
            ],
            'systema-auth.rest.role' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/role[/:roleId]',
                    'defaults' => [
                        'controller' => 'SystemaAuth\\V1\\Rest\\Role\\Controller',
                    ],
                ],
            ],
            'systema-auth.rest.resource' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/resource[/:resource_id]',
                    'defaults' => [
                        'controller' => 'SystemaAuth\\V1\\Rest\\Resource\\Controller',
                    ],
                ],
            ],
            'systema-auth.rest.session' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/session[/:session_id]',
                    'defaults' => [
                        'controller' => 'SystemaAuth\\V1\\Rest\\Session\\Controller',
                    ],
                ],
            ],
            'systema-auth.rest.address' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/address[/:address_id]',
                    'defaults' => [
                        'controller' => 'SystemaAuth\\V1\\Rest\\Address\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'systema-auth.rest.login',
            1 => 'systema-auth.rest.role',
            2 => 'systema-auth.rest.resource',
            3 => 'systema-auth.rest.session',
            4 => 'systema-auth.rest.address',
        ],
    ],
    'api-tools-rest' => [
        'SystemaAuth\\V1\\Rest\\Login\\Controller' => [
            'listener' => \SystemaAuth\V1\Rest\Login\LoginResource::class,
            'route_name' => 'systema-auth.rest.login',
            'route_identifier_name' => 'login_id',
            'collection_name' => 'login',
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
            'entity_class' => \SystemaAuth\V1\Rest\Login\LoginEntity::class,
            'collection_class' => \SystemaAuth\V1\Rest\Login\LoginCollection::class,
            'service_name' => 'login',
        ],
        'SystemaAuth\\V1\\Rest\\Role\\Controller' => [
            'listener' => \SystemaAuth\V1\Rest\Role\RoleResource::class,
            'route_name' => 'systema-auth.rest.role',
            'route_identifier_name' => 'roleId',
            'collection_name' => 'role',
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
            'entity_class' => \SystemaAuth\V1\Rest\Role\RoleEntity::class,
            'collection_class' => \SystemaAuth\V1\Rest\Role\RoleCollection::class,
            'service_name' => 'role',
        ],
        'SystemaAuth\\V1\\Rest\\Resource\\Controller' => [
            'listener' => \SystemaAuth\V1\Rest\Resource\ResourceResource::class,
            'route_name' => 'systema-auth.rest.resource',
            'route_identifier_name' => 'resource_id',
            'collection_name' => 'resource',
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
            'entity_class' => \SystemaAuth\V1\Rest\Resource\ResourceEntity::class,
            'collection_class' => \SystemaAuth\V1\Rest\Resource\ResourceCollection::class,
            'service_name' => 'resource',
        ],
        'SystemaAuth\\V1\\Rest\\Session\\Controller' => [
            'listener' => \SystemaAuth\V1\Rest\Session\SessionResource::class,
            'route_name' => 'systema-auth.rest.session',
            'route_identifier_name' => 'session_id',
            'collection_name' => 'session',
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
            'entity_class' => \SystemaAuth\V1\Rest\Session\SessionEntity::class,
            'collection_class' => \SystemaAuth\V1\Rest\Session\SessionCollection::class,
            'service_name' => 'session',
        ],
        'SystemaAuth\\V1\\Rest\\Address\\Controller' => [
            'listener' => \SystemaAuth\V1\Rest\Address\AddressResource::class,
            'route_name' => 'systema-auth.rest.address',
            'route_identifier_name' => 'address_id',
            'collection_name' => 'address',
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
            'entity_class' => \SystemaAuth\V1\Rest\Address\AddressEntity::class,
            'collection_class' => \SystemaAuth\V1\Rest\Address\AddressCollection::class,
            'service_name' => 'address',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'SystemaAuth\\V1\\Rest\\Login\\Controller' => 'HalJson',
            'SystemaAuth\\V1\\Rest\\Role\\Controller' => 'HalJson',
            'SystemaAuth\\V1\\Rest\\Resource\\Controller' => 'HalJson',
            'SystemaAuth\\V1\\Rest\\Session\\Controller' => 'HalJson',
            'SystemaAuth\\V1\\Rest\\Address\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'SystemaAuth\\V1\\Rest\\Login\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Role\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Resource\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Session\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Address\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'SystemaAuth\\V1\\Rest\\Login\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Role\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Resource\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Session\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/json',
            ],
            'SystemaAuth\\V1\\Rest\\Address\\Controller' => [
                0 => 'application/vnd.systema-auth.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \SystemaAuth\V1\Rest\Login\LoginEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.login',
                'route_identifier_name' => 'login_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SystemaAuth\V1\Rest\Login\LoginCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.login',
                'route_identifier_name' => 'login_id',
                'is_collection' => true,
            ],
            \SystemaAuth\V1\Rest\Role\RoleEntity::class => [
                'entity_identifier_name' => 'roleId',
                'route_name' => 'systema-auth.rest.role',
                'route_identifier_name' => 'roleId',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SystemaAuth\V1\Rest\Role\RoleCollection::class => [
                'entity_identifier_name' => 'roleId',
                'route_name' => 'systema-auth.rest.role',
                'route_identifier_name' => 'roleId',
                'is_collection' => true,
            ],
            \SystemaAuth\V1\Rest\Resource\ResourceEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.resource',
                'route_identifier_name' => 'resource_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SystemaAuth\V1\Rest\Resource\ResourceCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.resource',
                'route_identifier_name' => 'resource_id',
                'is_collection' => true,
            ],
            \SystemaAuth\V1\Rest\Session\SessionEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.session',
                'route_identifier_name' => 'session_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SystemaAuth\V1\Rest\Session\SessionCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.session',
                'route_identifier_name' => 'session_id',
                'is_collection' => true,
            ],
            \SystemaAuth\V1\Rest\Address\AddressEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.address',
                'route_identifier_name' => 'address_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \SystemaAuth\V1\Rest\Address\AddressCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'systema-auth.rest.address',
                'route_identifier_name' => 'address_id',
                'is_collection' => true,
            ],
        ],
    ],
];
