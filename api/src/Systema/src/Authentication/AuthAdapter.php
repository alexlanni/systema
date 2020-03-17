<?php


namespace Systema\Authentication;

use Laminas\ApiTools\MvcAuth\Authentication\AbstractAdapter;
use Laminas\ApiTools\MvcAuth\Identity\{GuestIdentity,AuthenticatedIdentity};
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Http\Request;
use Laminas\Http\Response;


class AuthAdapter extends AbstractAdapter
{
    /**
     * Authentication types this adapter provides.
     *
     * @var array
     */
    private array $providesTypes = ['SystemaAuth'];

    /**
     * @inheritDoc
     */
    public function provides()
    {
       return $this->providesTypes;
    }

    /**
     * @inheritDoc
     */
    public function matches($type)
    {
        return in_array($type, $this->providesTypes);
    }

    /**
     * @inheritDoc
     */
    public function preAuth(Request $request, Response $response)
    {

    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request, Response $response, MvcAuthEvent $mvcAuthEvent)
    {
        $token = 'abcd';
        $user_id = 'sddssdds';

        // Se l'authenticazione avviene:
        $identity = new AuthenticatedIdentity($token);
        $identity->setName($user_id);
        return $identity;


        // Se l'authenticazione non avviene:
        return new GuestIdentity();
        print_r($request);

        die();
        $request->getPost();
    }
}