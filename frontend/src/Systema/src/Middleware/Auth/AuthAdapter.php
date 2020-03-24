<?php


namespace Systema\Middleware\Auth;

use Firebase\JWT\JWT;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Template\TemplateRendererInterface;

class AuthAdapter implements AuthenticationInterface
{

    /** @var TemplateRendererInterface $renderer */
    private $renderer;

    /** @var array $config */
    private $config;

    public function __construct(TemplateRendererInterface $renderer, array $config)
    {
        $this->renderer = $renderer;
        $this->config = $config;
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

        // TODO: Verifica con Le API che la sessione sia attiva

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