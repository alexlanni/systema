# Systema Core

2020 - Alessandro Lanni


## TODO

- Aggiungere e configurare Doctrine
- Configurare oauth2
- Aggiungere mezzio

## Doctrine

Come generare le entita' dal DB:

````
docker-compose exec api php ./vendor/bin/doctrine-module orm:convert-mapping --namespace="Systema\\Entities\\" --force --from-database annotation ./EXPORT/

docker-compose exec api php ./vendor/bin/doctrine-module orm:generate-entities --update-entities="true" --generate-methods="true" ./EXPORT/.
````

#### Collection, Paginators e Adapters

Per consentire il passaggio dei dati daDoctrine a REST, e' utile ottenere con il queryBuilder la Query:

`````
$localTypeRepo = $this->getORM()->getRepository(LocalType::class);
$queryBuilder = $localTypeRepo->createQueryBuilder('lt');
$query = $queryBuilder->getQuery();
`````

Ottenuta la query, si passa alla creazione di un PaginatorAdapter di Doctrine:

````
$adapter = new \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator(new \Doctrine\ORM\Tools\Pagination\Paginator($adapter));
````

L'adapter ottenuto puo' essere usato come Collection.

###### Abstract Systema\Paginator\PaginatorAbstract

Vedere i file `api/module/Systema/src/V1/Rest/LocalType/LocalTypeCollection.php` per capire l'implementazione.



## Authentication e Authorization

Per innestare la propria gestione di Authentication e Authorization aggiungere nel file `module.config.php`

````
'service_manager' => [
        'factories' => [
            ...
            \Systema\Authentication\AuthAdapter::class => \Systema\Authentication\AuthAdapterFactory::class
        ],
        'delegators' => [
            \Laminas\ApiTools\MvcAuth\Authentication\DefaultAuthenticationListener::class => [
                \Systema\Authentication\AuthDelegatorFactory::class,
            ],
            \Laminas\ApiTools\MvcAuth\Authorization\DefaultAuthorizationListener::class => [
                \Systema\Authorization\AuthorizationListener::class,
            ],
        ],
    ],
````

Aggiungere anche la configurazione delle strategie di autenticazione:

````
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
            .....
````

Da notare che il nome dell'adapter `SystemaAuth` deve essere riportato nella proprietá `private array $providesTypes = ['SystemaAuth'];` del file AuthAdapter (Service).


