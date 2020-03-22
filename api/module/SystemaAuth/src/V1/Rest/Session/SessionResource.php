<?php
namespace SystemaAuth\V1\Rest\Session;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Systema\Authentication\Session;
use Systema\Entities\Role;
use Systema\Entities\Token;
use Systema\Service\SystemaService;

class SessionResource extends AbstractResourceListener
{
    /** @var SystemaService $service */
    private SystemaService $service;

    private int $sessionTTL = 3660;

    private string $privateKey;

    public function __construct(SystemaService $service, int $sessionTTL, string $privateKey)
    {
        $this->service = $service;
        /** @var int sessionTTL Durata della sessione */
        $this->sessionTTL = (!empty($sessionTTL))?$sessionTTL:$this->sessionTTL;

        /** @var string privateKey path della chiave privata */
        $this->privateKey = $privateKey;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try{
            // Verifica le credenziali di accesso
            $verificationResult = $this->service->validateLogin($data->email, $data->password);

            // Ottengo il Ruolo
            $roles = $verificationResult->getRoles();
            if (count($roles) == 0)
            {
                return new ApiProblem(500, 'No roles applied for this LoginId');
            }

            /** @var Role $role */
            $role = $roles[0];

            // Creo la sessione a partire la Login Ricevuto
            $session = new Session('',$verificationResult->getLoginId(),$verificationResult->getEmail(),$this->sessionTTL, $role->getRoleId());

            // Salvo il Token ...
            $token = $this->service->createToken($session);

            $session->setTokenId($token->getTokenId());

            // .. e lo ritorno in formato cryptato
            $sessionEntity = new SessionEntity();
            $sessionEntity->setData($token->getData());
            $sessionEntity->setTokenId($token->getTokenId());
            return $sessionEntity;

        } catch (\Exception $ex ){
            switch ($ex->getCode()) {
                case $this->service::ERR_EMAIL_NOT_FOUND:
                    return new ApiProblem(404, $ex->getMessage());
                    break;
                case $this->service::ERR_INVALID_CREDENTIALS:
                    return new ApiProblem(403, $ex->getMessage());
                    break;
                default:
                    return new ApiProblem(500, $ex->getMessage());
                    break;
            }
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            $check = $this->service->checkToken($id);

            if(!$check instanceof Token)
                return new ApiProblem(404, 'Invalid Session ID');

            $session  = new SessionEntity();
            $session->setTokenId($check->getTokenId())
                ->setData($check->getData());

            return $session;

        }catch (\Exception $ex) {

            switch ($ex->getCode()){

                case $this->service::ERR_TOKEN_EXPIRED:
                    return new ApiProblem(410, $ex->getMessage());
                    break;
                case $this->service::ERR_TOKEN_NOT_FOUND:
                    return new ApiProblem(404, $ex->getMessage());
                    break;
                default:
                    return new ApiProblem(400, 'Token not recognized');
                    break;

            }


        }


    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {

        try {
            $check = $this->service->refreshToken($id);
            if(!$check instanceof Token)
                return new ApiProblem(404, 'Invalid Session ID');

            $session  = new SessionEntity();
            $session->setTokenId($check->getTokenId())
                ->setData($check->getData());

            return $session;

        }catch (\Exception $ex) {

            switch ($ex->getCode()){

                case $this->service::ERR_TOKEN_EXPIRED:
                    return new ApiProblem(410, $ex->getMessage());
                    break;
                case $this->service::ERR_TOKEN_NOT_FOUND:
                    return new ApiProblem(404, $ex->getMessage());
                    break;
                default:
                    return new ApiProblem(400, 'Token not recognized');
                    break;

            }


        }

    }
}
