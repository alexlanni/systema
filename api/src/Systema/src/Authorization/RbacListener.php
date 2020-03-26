<?php


namespace Systema\Authorization;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Hal\Collection;
use Laminas\ApiTools\MvcAuth\Authorization\AuthorizationInterface;
use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\ApiTools\MvcAuth\Identity\IdentityInterface;
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Authentication\AuthenticationService;
use Laminas\Http\Request;
use Laminas\Mvc\MvcEvent;
use Systema\Authorization\AuthorizationService;

class RbacListener
{
    /**
     * @inheritDoc
     */
    public function __invoke(MvcEvent $mvcEvent)
    {

        /** @var \Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity $identity */
        $identity = $mvcEvent->getApplication()->getServiceManager()->get('authentication')->getIdentity();

        if ($identity instanceof AuthenticatedIdentity && $mvcEvent->getRequest()->getMethod() == Request::METHOD_GET) {

            /** @var AuthorizationService $authorizationService */
            $authorizationService = $mvcEvent->getApplication()
                ->getServiceManager()
                ->get(AuthorizationService::class);

            /** @var \Laminas\ApiTools\Hal\View\HalJsonModel $resource */
            $resource = $mvcEvent->getResult();

            /** @var \Laminas\ApiTools\Hal\Collection|mixed $payload */
            $payload = $resource->getPayload();

            if ($payload instanceof Collection) {
                $isGranted = $authorizationService->checkOwnerOnEntity($identity, $payload);
            } else {
                $isGranted = $authorizationService->checkOwnerOnCollection($identity, $payload);
            }

            //$mvcEvent->getApplication()->


        }

    }



}