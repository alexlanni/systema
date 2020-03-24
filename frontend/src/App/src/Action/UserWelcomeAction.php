<?php

declare(strict_types=1);

namespace App\Action;

use Mezzio\Authentication\UserInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Systema\Middleware\Auth\Session;

class UserWelcomeAction implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        /** @var Session $user */
        $user = $request->getAttribute(UserInterface::class);

        print_r($user->getDetails());
        die;

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'app::user-welcome',
            [] // parameters to pass to template
        ));
    }
}
