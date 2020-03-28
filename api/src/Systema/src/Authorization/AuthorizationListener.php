<?php


namespace Systema\Authorization;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\ApiProblemResponse;
use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;

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

            $method = $mvcAuthEvent->getMvcEvent()->getRequest()->getMethod();
            $request = $mvcAuthEvent->getMvcEvent()->getRouteMatch()->getMatchedRouteName();

            $mvcAuthEvent->setIsAuthorized(
                $authorizationService->checkGrantOnResource($identity, $request, $method)
            );

            $problem = new ApiProblem(401, 'Current role cannott access the ' . $request . ' resource.');
            $mvcAuthEvent->getMvcEvent()->setResponse(
                new ApiProblemResponse($problem)
            );

        }
    }
}