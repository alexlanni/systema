<?php

declare(strict_types=1);

namespace Sso\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class Login implements RequestHandlerInterface
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

        print_r($request->getMethod());

        die();

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'sso::login',
            [] // parameters to pass to template
        ));
    }
}
