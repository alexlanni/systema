<?php
/**
 * Servizio Authorization
 *
 * Nel servizio vengono definiti i ruoli ed i permessi
 *
 */

namespace Systema\Authorization;

use Laminas\ApiTools\Hal\Collection;
use Laminas\ApiTools\MvcAuth\Identity\{GuestIdentity,AuthenticatedIdentity};
use Laminas\Permissions\Rbac\Rbac;
use Laminas\Permissions\Rbac\Role;

class AuthorizationService
{

    public const ROLE_GUEST = 'guest';
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPERADMIN = 'superadmin';

    /** @var array $authorizationConfig */
    private $authorizationConfig = [];

    /** @var Rbac $systemaRbac */
    private $systemaRbac;

    /**
     * AuthorizationService constructor.
     *
     * @param array $authorizationConfig
     */
    public function __construct(array $authorizationConfig)
    {
        $this->authorizationConfig = $authorizationConfig;

        $this->systemaRbac = new Rbac();

        // Definisco i ruoli
        $roleGuest = new Role(self::ROLE_GUEST);
        $roleUser = new Role(self::ROLE_USER);
        $roleAdmin = new Role(self::ROLE_ADMIN);
        $roleSuperAdmin = new Role(self::ROLE_SUPERADMIN);

        // Aggiungo i Ruoli al RBAC
        $this->systemaRbac->addRole($roleGuest);
        $this->systemaRbac->addRole($roleSuperAdmin);
        $this->systemaRbac->addRole($roleAdmin, $roleSuperAdmin);
        $this->systemaRbac->addRole($roleUser, $roleAdmin);

        // Aggiungere i Permessi ai Ruoli

        // TODO: spostare in config
        $this->systemaRbac->getRole(self::ROLE_USER)->addPermission('systema.rest.local-type');

    }

    /**
     * Verifica se il ruolo in sessione puo' accedere alla risorsa
     *
     * @param AuthenticatedIdentity $identity
     * @param $routeMatchName
     * @param null $method
     * @return bool
     */
    public function checkGrantOnResource(AuthenticatedIdentity $identity, $routeMatchName, $method = null) {

        // TODO: gestire Method
        return $this->systemaRbac->isGranted($identity->getRoleId(), $routeMatchName);
    }

    /**
     * Verifica, usando implementazioni di AssertionInterface se l'utente in sessione puo' accedere alla risorsa
     * che stiamo inviando
     *
     * @param AuthenticatedIdentity $identity
     * @param mixed $resource
     */
    public function checkOwnerOnEntity(AuthenticatedIdentity $identity, $resource) {
        // TODO: check

    }

    /**
     * Verifica, usando implementazioni di AssertionInterface se l'utente in sessione puo' accedere alla risorsa
     * Collection che stiamo inviando
     *
     * @param AuthenticatedIdentity $identity
     * @param mixed $resource
     */
    public function checkOwnerOnCollection(AuthenticatedIdentity $identity, Collection $resource) {

    }


}