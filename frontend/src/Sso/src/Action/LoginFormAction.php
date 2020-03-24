<?php

declare(strict_types=1);

namespace Sso\Action;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Http\Cookies;
use Laminas\Http\Header\SetCookie;
use Laminas\Http\Headers;
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

    /** @var array $config */
    private $config;

    public function __construct(TemplateRendererInterface $renderer, CoreApiService $coreApiService, array $config)
    {
        $this->renderer = $renderer;
        $this->coreApiService = $coreApiService;
        $this->config = $config;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $formOptions = [
            'method' => 'POST'
        ];
        $form = new LoginForm('login', $formOptions);

        $errorContainer = [];
        $headers = [];
        $userLoggedIn = false;



        // Nel caso in cui stanno eseguendo un POST, verifico il form
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

                    $cookieExpireAt = new \DateTime('now');

                    $cookieExpireAt->add(new \DateInterval('PT1H'));

                    $cookie = new SetCookie(
                        $this->config['session-cookie-name'],
                        $responseBody['data'],
                        $cookieExpireAt->format('Y-m-d H:i:s'),
                        '/',
                        $this->config['session-cookie-domain'],
                        true
                    );

                    $headersObject = Headers::fromString($cookie->toString());
                    $headers = $headersObject->toArray();
                    $userLoggedIn = true;

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
                'errors' => $errorContainer,
                'isLogged' => $userLoggedIn
            ]
        ),
        200,
            $headers);
    }
}
