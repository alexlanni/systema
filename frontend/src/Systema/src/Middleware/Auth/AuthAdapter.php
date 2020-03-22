<?php


namespace Systema\Middleware\Auth;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Mezzio\Template\TemplateRendererInterface;

class AuthAdapter implements AuthenticationInterface
{

    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(ServerRequestInterface $request): ?UserInterface
    {
        //return new Session();
        return null;
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