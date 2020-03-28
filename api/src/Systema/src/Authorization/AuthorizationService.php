<?php
/**
 * Servizio Authorization
 *
 * Nel servizio vengono definiti i ruoli ed i permessi
 *
 */

namespace Systema\Authorization;

use Laminas\ApiTools\MvcAuth\Identity\{AuthenticatedIdentity};
use Laminas\Permissions\Rbac\AssertionInterface;
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

    /** @var array $dynamicAssertions */
    private array $dynamicAssertions = [];

    /**
     * AuthorizationService constructor.
     *
     * @param array $authorizationConfig
     */
    public function __construct(array $authorizationConfig, array $systemaAuth)
    {
        $this->authorizationConfig = $authorizationConfig;
        $this->dynamicAssertions = $systemaAuth['owner-assertions'];
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

        // Permesso di Accesso alle risorse
        $this->systemaRbac->getRole(self::ROLE_USER)->addPermission('accessEntity');
        $this->systemaRbac->getRole(self::ROLE_USER)->addPermission('accessCollection');

        // Aggiugo i permessi dal file di configurazione
        foreach ($systemaAuth['rbac'] as $role => $permissions) {
            foreach ($permissions as $permission) {
                $this->systemaRbac->getRole($role)->addPermission($permission);
            }
        }
    }

    /**
     * Verifica se il ruolo in sessione puo' accedere alla risorsa
     *
     * @param AuthenticatedIdentity $identity
     * @param $routeMatchName
     * @param null $method
     * @return bool
     */
    public function checkGrantOnResource(AuthenticatedIdentity $identity, $routeMatchName, $method = null)
    {
        return $this->systemaRbac->isGranted($identity->getRoleId(), $routeMatchName);
    }

    /**
     * Verifica, usando implementazioni di AssertionInterface se l'utente in sessione puo' accedere alla risorsa
     * che stiamo inviando
     *
     * @param AuthenticatedIdentity $identity
     * @param mixed $resource
     * @return bool
     */
    public function checkOwnerOnEntity(AuthenticatedIdentity $identity, $resource)
    {
        // Ottengo la classe dell'Assertion Da usare, partendo dalla classe dell'entita' in uso
        $dynamicAssertionClassName = (isset($this->dynamicAssertions[get_class($resource)])) ?
            $this->dynamicAssertions[get_class($resource)] :
            $this->dynamicAssertions['default'];

        /**
         * Assertion Class
         *
         * @var AssertionInterface $dynamicAssertion
         */
        $dynamicAssertion = new $dynamicAssertionClassName($identity);
        $dynamicAssertion->setEntity($resource);
        return $this->systemaRbac->isGranted($identity->getRoleId(), 'accessEntity', $dynamicAssertion);
    }

    /**
     * Verifica, usando implementazioni di AssertionInterface se l'utente in sessione puo' accedere alla risorsa
     * Collection che stiamo inviando
     *
     * @param AuthenticatedIdentity $identity
     * @param mixed $resource
     * @return bool
     */
    public function checkOwnerOnCollection(AuthenticatedIdentity $identity, $resource)
    {

        $dynamicAssertionClassName = (isset($this->dynamicAssertions[get_class($resource)])) ?
            $this->dynamicAssertions[get_class($resource)] :
            $this->dynamicAssertions['collection-default'];

        /**
         * Assertion Class
         *
         * @var AssertionInterface $dynamicAssertion
         */
        $dynamicAssertion = new $dynamicAssertionClassName($identity);
        $dynamicAssertion->setCollection($resource);
        return $this->systemaRbac->isGranted($identity->getRoleId(), 'accessCollection', $dynamicAssertion);
    }
}
