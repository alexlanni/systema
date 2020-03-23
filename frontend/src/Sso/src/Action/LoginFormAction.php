<?php

declare(strict_types=1);

namespace Sso\Action;

use Laminas\Http\Request;
use Laminas\Http\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Systema\Form\LoginForm;
use Systema\Middleware\Service\CoreApiService;

class LoginFormAction implements RequestHandlerInterface
{

    /** @var TemplateRendererInterface */
    private $renderer;

    /** @var CoreApiService Servizio Core API */
    private CoreApiService $coreApiService;

    public function __construct(TemplateRendererInterface $renderer, CoreApiService $coreApiService)
    {
        $this->renderer = $renderer;
        $this->coreApiService = $coreApiService;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {

        $formOptions = [
            'method' => 'POST'
        ];
        $form = new LoginForm('login', $formOptions);

        $errorContainer = [];

        // NEl caso in cui stanno eseguendo un POST, verifico il form
        if ($request->getMethod() == 'POST') {
            $form->setData($request->getParsedBody());
            $valid = $form->isValid();

            // Se valido, procedo alla richiesta di Login Remoto
            if ($valid) {
                $response = $this->coreApiService->invokeSession(
                    $form->get('email')->getValue(),
                    $form->get('password')->getValue()
                );

                $responseHttpStatus = $response->getStatusCode();
                $responseBody = json_decode($response->getBody(),true);

                if($responseHttpStatus == 201){
                    setcookie('test',$responseBody['data'], 3600);
                }else{
                    $errorContainer[] = new \Error('Credenziali non valide', $responseBody['status']);
                }
            }

        }

        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'sso::login-form',
            [
                'form' => $form,
                'errors' => $errorContainer
            ] // parameters to pass to template
        ));
    }
}
