<?php

declare(strict_types=1);

namespace Sso\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Systema\Form\LoginForm;

class ProcessLoginAction implements RequestHandlerInterface
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
        $params = $request->getParsedBody();
        $form = new LoginForm();
        $form->setData($params);
        var_dump($form->isValid());
        var_dump($form->getMessages());

        die;

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'sso::process-login',
            [] // parameters to pass to template
        ));
    }
}
