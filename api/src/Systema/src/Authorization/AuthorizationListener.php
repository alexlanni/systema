<?php


namespace Systema\Authorization;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Hal\Collection;
use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Http\Request;

class AuthorizationListener
{
    /**
     * @inheritDoc
     */
    public function __invoke(MvcAuthEvent $mvcAuthEvent)
    {
        /** @var \Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity $identity */
        $identity = $mvcAuthEvent->getIdentity();

        if ($identity instanceof AuthenticatedIdentity) {

            /** @var AuthorizationService $authorizationService */
            $authorizationService = $mvcAuthEvent->getMvcEvent()->getApplication()
                ->getServiceManager()
                ->get(AuthorizationService::class);

            /** @var \Laminas\ApiTools\ContentNegotiation\Request $resource */
            $resource = $mvcAuthEvent->getMvcEvent()->getRequest();

            $method = $mvcAuthEvent->getMvcEvent()->getRequest()->getMethod();
            $request = $mvcAuthEvent->getMvcEvent()->getRouteMatch()->getMatchedRouteName();

            $mvcAuthEvent->setIsAuthorized(
                $authorizationService->checkGrantOnResource($identity, $request, $method)
            );

        }
    }
}