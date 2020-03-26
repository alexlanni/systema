<?php

namespace Systema\Middleware\Service;

use Laminas\Http\Client;
use Laminas\Http\Request;
use Laminas\Http\Response;

class CoreApiService
{

    /** @var array $config  Configurazione del servizio */
    private array $config = [];

    /** @var Client $client Client HTTP */
    private $client;

    /** @var string $sessionToken */
    private string $sessionToken = '';

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Crea una Request basica, settando URL delle API e heade Accept, Content-Type
     *
     * @return Request
     */
    private function createBasicRequest(string $requestPath, string $method = Request::METHOD_GET, string $xForwardedFor = null): Request
    {
        $request = new Request();
        $request->setUri($this->config['core-api']['url'] . $requestPath)
            ->setMethod($method)
            ->getHeaders()->addHeaderLine('Accept','application/json')
                          ->addHeaderLine('Content-Type', 'application/json');

        if(!empty($this->sessionToken))
            $request->getHeaders()->addHeaderLine('X-Systema-Auth', $this->sessionToken);

        if ($xForwardedFor == null)
            $xForwardedFor = (isset($_SERVER['HTTP_X_FORWARDED_FOR']))?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_USER_AGENT']))
            $request->getHeaders()->addHeaderLine('X-Forwarded-User-Agent', $_SERVER['HTTP_USER_AGENT']);

        $request->getHeaders()->addHeaderLine('X-Forwarded-For',$xForwardedFor);

        return $request;
    }

    /**
     * Ritorna il Client HTTP per inviare le richieste
     *
     * @return Client
     */
    private function getClient(): Client
    {
        if (!$this->client instanceof Client)
            $this->client = new Client();

        return $this->client;
    }

    /**
     * Imposta il token di sessione da usare con le API
     *
     * @param string $sessionToken
     */
    public function setSessionToken(string $sessionToken)
    {
        $this->sessionToken = $sessionToken;
    }

    /**
     * Invoca il metodo POST/Session sulle API
     *
     * @param string $email
     * @param string $password
     * @return Response
     */
    public function invokeCreateSession(string $email, string $password): Response
    {
        $request = $this->createBasicRequest('/session', Request::METHOD_POST);

        $bodyPArams = json_encode([
            'email'=>$email,
            'password'=>$password
        ]);

        $request->setContent($bodyPArams);
        return $this->getClient()->send($request);
    }

    /**
     * Invoca il check della sessione mediante API
     *
     * @param string $tokenId
     * @return Response
     */
    public function invokeCheckSession(string $tokenId): Response
    {
        $request = $this->createBasicRequest(sprintf('/session/%s' , $tokenId), Request::METHOD_GET);
        return $this->getClient()->send($request);
    }

}