# Systema Core

2020 - Alessandro Lanni


## TODO

- Aggiungere e configurare Doctrine
- Configurare oauth2
- Aggiungere mezzio

## Doctrine

Come generare le entita' dal DB:

````
docker-compose exec api php ./vendor/bin/doctrine-module orm:convert-mapping --namespace="Systema\\Entities\\" --force --from-database annotation ./EXPORT/ --generate-methods="true"

docker-compose exec api php ./vendor/bin/doctrine-module orm:generate-entities --update-entities="true" --generate-methods="true" ./EXPORT/.
````
