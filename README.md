# Systema Core

2020 - Alessandro Lanni

## Docker-Compose UID

Prima di avviare docker-compose up -d, lanciare:

````
export UID=${UID}
export GID=${GID}
````


## TODO

- Aggiungere e configurare Doctrine
- Configurare oauth2
- Aggiungere mezzio

## Middleware

Unit test:

`
docker-compose exec middleware composer check
`

Mezzio CLI:

`docker-compose exec middleware composer mezzio`