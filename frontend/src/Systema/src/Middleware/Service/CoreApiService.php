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

        if ($xForwardedFor != null) {
            $request->getHeaders()->addHeaderLine('X-Forwarded-For',$xForwardedFor);
        }

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
     * Invoca il metodo POST/Session sulle API
     *
     * @param string $email
     * @param string $password
     * @return Response
     */
    public function invokeSession(string $email, string $password): Response
    {

        $clientIp = $_SERVER['REMOTE_ADDR'];

        $request = $this->createBasicRequest('/session', Request::METHOD_POST, $clientIp);

        $bodyPArams = json_encode([
            'email'=>$email,
            'password'=>$password
        ]);

        $request->setContent($bodyPArams);

        return $this->getClient()->send($request);
    }

}