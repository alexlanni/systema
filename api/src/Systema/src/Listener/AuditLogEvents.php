<?php


namespace Systema\Listener;


use Laminas\ApiTools\MvcAuth\Identity\AuthenticatedIdentity;
use Laminas\Authentication\AuthenticationService;
use Laminas\EventManager\EventInterface;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\ListenerAggregateInterface;
use Laminas\Mvc\MvcEvent;
use Systema\Authentication\Session;
use Systema\Service\AuditLogService;

class AuditLogEvents implements ListenerAggregateInterface
{
    /** @var AuditLogService $alService Audit Log Service */
    private AuditLogService $alService;

    private $listeners = [];

    public function __construct(AuditLogService $alService)
    {
        $this->alService = $alService;
    }

    /**
     * @inheritDoc
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, [$this, 'doAudit']);
    }

    /**
     * @inheritDoc
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            $events->detach($listener);
            unset($this->listeners[$index]);
        }
    }

    public function doAudit(EventInterface $e)
    {

        $event  = $e->getName();
        // "application":{},"request":{},"response":{},"router":{},"route-match":{},"Laminas\\ApiTools\\MvcAuth\\Identity":{}
        $params = $e->getParams();

        /** @var \Laminas\Mvc\Application $target */
        $target = $e->getTarget();

        /** @var \Laminas\ApiTools\MvcAuth\Identity\IdentityInterface $authIdentity */
        $authIdentity = $target->getServiceManager()->get('api-identity');

        /** @var \Laminas\ApiTools\ContentNegotiation\Request $request */
        $request = $params['request'];

        // Ottengo il token
        $token = $request->getHeader('X-Systema-Auth');
        $requestUri = $request->getRequestUri();
        $method = $request->getMethod();

        // Identity
        $identityType = $authIdentity->getName();
        $identityRole = $authIdentity->getRoleId();
        $identity = $authIdentity->getAuthenticationIdentity();
        $identityId = 0;
        $identitToken = '';
        if ($identity instanceof Session) {
            $identityId = $identity->getLoginId();
            $identitToken = $identity->getTokenId();
        }

        // Oggetto Server
        $server = $request->getServer();

        $clientIp = $server['REMOTE_ADDR'];
        $clientUA = $server['HTTP_USER_AGENT'];

        // Status Code Risposta
        /** @var \Laminas\Http\PhpEnvironment\Response $response */
        $response = $params['response'];
        $responseHttpStatusCode = $response->getStatusCode();

        $this->alService->doAudit($requestUri,
            $method,
            $identityType,
            $identityRole,
            $identityId,
            $identitToken,
            $clientIp,
            $clientUA,
            $responseHttpStatusCode);

    }

}