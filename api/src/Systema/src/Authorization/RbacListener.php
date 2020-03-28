<?php

namespace Systema\Authorization;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\ApiProblemResponse;
use Laminas\ApiTools\Hal\Collection;
use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\Http\Request;
use Laminas\Mvc\MvcEvent;
use Systema\Authorization\Interfaces\AssertOwnerInterface;

/**
 * Class RbacListener
 *
 * @package Systema\Authorization
 */
class RbacListener
{
    /**
     * @inheritDoc
     */
    public function __invoke(MvcEvent $mvcEvent)
    {

        /**
         * Identita' in sessione
         *
         * @var \Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity $identity
         */
        $identity = $mvcEvent->getApplication()
            ->getServiceManager()
            ->get('authentication')
            ->getIdentity();

        if (
            $identity instanceof AuthenticatedIdentity
            && $mvcEvent->getRequest()->getMethod() == Request::METHOD_GET
        ) {
            /**
             * Authorization Service
             *
             * @var AuthorizationService $authorizationService
             */
            $authorizationService = $mvcEvent->getApplication()
                ->getServiceManager()
                ->get(AuthorizationService::class);

            /**
             * Oggetto Resource, il pacchetto che stiamo tornando
             *
             * @var \Laminas\ApiTools\Hal\View\HalJsonModel $resource
             */
            $resource = $mvcEvent->getResult();

            /**
             * Entita' o collection  contenuta nella resource
             *
             * @var \Laminas\ApiTools\Hal\Collection|mixed $payload
             */
            $payload = $resource->getPayload();

            $isGranted = false;
            if (
                $payload instanceof Collection &&
                $payload->getCollection() instanceof AssertOwnerInterface
            ) {
                if ($payload->getCollection()->isAlwaysGranted()) {
                    return true;
                } else {
                    $isGranted = $authorizationService
                        ->checkOwnerOnCollection($identity, $payload->getCollection());
                }

            } elseif ($payload->getEntity() instanceof AssertOwnerInterface) {
                if ($payload->getEntity()->isAlwaysGranted()) {
                    $isGranted = true;
                } else {
                    $isGranted = $authorizationService
                        ->checkOwnerOnEntity($identity, $payload->getEntity());
                }
            }

            if (!$isGranted) {
                $problem = new ApiProblem(401, 'Ownership check failed');
                $mvcEvent->setResponse(
                    new ApiProblemResponse($problem)
                );
            }
        }
    }
}
