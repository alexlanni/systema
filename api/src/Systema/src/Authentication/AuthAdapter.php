<?php


namespace Systema\Authentication;

use http\Header;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\MvcAuth\Authentication\AbstractAdapter;
use Laminas\ApiTools\MvcAuth\Identity\{GuestIdentity,AuthenticatedIdentity};
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Http\Header\HeaderInterface;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Systema\Entities\Token;
use Systema\Service\SystemaService;
use SystemaAuth\V1\Rest\Session\SessionEntity;


class AuthAdapter extends AbstractAdapter
{
    /**
     * Authentication types this adapter provides.
     *
     * @var array
     */
    private array $providesTypes = ['SystemaAuth'];

    /** @var SystemaService $service */
    private SystemaService $service;

    private int $sessionTTL;
    private string $keyFilePath;

    public function __construct(SystemaService $service, int $sessionTTL = 3600, $keyFilePath)
    {
        $this->service = $service;
        $this->sessionTTL = $sessionTTL;
        $this->keyFilePath = $keyFilePath;
    }

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
        /** @var HeaderInterface|bool $xAuthKey token in header */
        $xAuthKey = $request->getHeader('X-Systema-Auth');
        if( $xAuthKey === false )
            return new GuestIdentity();

        $session = new Session('', 0, '', $this->sessionTTL);
        $session->recreateFromJWT($xAuthKey->getFieldValue(), $this->keyFilePath);

        try {
            // Verifico la Sessione sul DB
            $check = $this->service->checkToken($session->getTokenId());
            if(!$check instanceof Token)
                return new GuestIdentity();

            $roleName = 'user'; //TODO: cambiare
            $identity = new AuthenticatedIdentity($session);
            $identity->setName($roleName);
            return $identity;


        }catch (\Exception $ex) {
            return new GuestIdentity();
        }
    }
}