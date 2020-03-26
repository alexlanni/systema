<?php


namespace Systema\Middleware\Auth;

use Firebase\JWT\JWT;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Template\TemplateRendererInterface;
use Systema\Middleware\Service\CoreApiService;

class AuthenticationAdapter implements AuthenticationInterface
{

    /** @var TemplateRendererInterface $renderer */
    private $renderer;

    /** @var array $config */
    private $config;

    /** @var CoreApiService $coreApiService */
    private CoreApiService $coreApiService;

    public function __construct(TemplateRendererInterface $renderer, array $config, CoreApiService $coreApiService)
    {
        $this->renderer = $renderer;
        $this->config = $config;
        $this->coreApiService = $coreApiService;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(ServerRequestInterface $request): ?UserInterface
    {

        if(!is_file($this->config['jwt-key-path']))
            throw new \Exception('Private Key File is unacessible');

        $privateKey = file_get_contents($this->config['jwt-key-path']);

        $cookies = $request->getCookieParams();
        if ( !isset($cookies[$this->config['session-cookie-name']])){
            return null;
        }
        $cookieData = $cookies[$this->config['session-cookie-name']];
        $plainData = JWT::decode($cookieData,$privateKey,['HS256']);

        // Verifico che la sessione non sia terminata.
        $this->coreApiService->setSessionToken($cookieData);
        $sessionCheck = $this->coreApiService->invokeCheckSession($plainData->tokenId);
        if ($sessionCheck->getStatusCode() != 200) {
            return null;
        }

        $session = new Session();
        $session->setIdentity($plainData->loginId)
            ->setRoles($plainData->roleId)
            ->setDetails((array)$plainData);
        return $session;
    }

    /**
     * @inheritDoc
     */
    public function unauthorizedResponse(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->renderer->render(
            'sso::unauthorized',
            [] // parameters to pass to template
        ));
    }
}