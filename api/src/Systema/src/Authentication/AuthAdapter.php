<?php


namespace Systema\Authentication;

use Exception;
use Laminas\ApiTools\MvcAuth\Authentication\AbstractAdapter;
use Laminas\ApiTools\MvcAuth\Identity\{AuthenticatedIdentity, GuestIdentity};
use Laminas\ApiTools\MvcAuth\MvcAuthEvent;
use Laminas\Http\Header\HeaderInterface;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Systema\Entities\Token;
use Systema\Service\SystemaService;

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

    public function __construct(SystemaService $service, int $sessionTTL = 3600, $keyFilePath = '')
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
        if ($xAuthKey === false) {
            return new GuestIdentity();
        }

        $session = new Session('', 0, '', $this->sessionTTL, 0);


        try {
            $session->recreateFromJWT($xAuthKey->getFieldValue(), $this->keyFilePath);
            // Verifico la Sessione sul DB
            $check = $this->service->checkToken($session->getTokenId());
            if (!$check instanceof Token) {
                return new GuestIdentity();
            }

            $roles = $check->getLogin()->getRoles();
            if (count($roles) > 0) {
                $roleName = $roles[0]->getLabel();
            } else {
                $roleName = 'user';
            }

            $identity = new AuthenticatedIdentity($session);
            $identity->setName($roleName);
            return $identity;
        } catch (Exception $ex) {
            error_log('Errore in authenticate: ' . $ex->getTraceAsString());
            return new GuestIdentity();
        }
    }
}
