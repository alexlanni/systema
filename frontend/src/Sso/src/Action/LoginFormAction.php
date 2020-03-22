<?php

declare(strict_types=1);

namespace Sso\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Systema\Form\LoginForm;

class LoginFormAction implements RequestHandlerInterface
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

        $formOptions = [
            'method' => 'POST'
        ];
        $form = new LoginForm('login', $formOptions);

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'sso::login-form',
            [
                'form' => $form
            ] // parameters to pass to template
        ));
    }
}
