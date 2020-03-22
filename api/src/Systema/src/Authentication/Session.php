<?php


namespace Systema\Authentication;


use Firebase\JWT\JWT;

class Session
{
    public string $tokenId;
    public int $loginId;
    public string $email;
    public \DateTime $access;
    public \DateTime $expire;
    public int $roleId;

    public function __construct(string $tokenId, int $loginId, string $email, int $sessionTTL, int $roleId)
    {
        $access = new \DateTime('now');
        $expireDate = new \DateTime('now');
        $expireDate->add(new \DateInterval('PT'.$sessionTTL.'S'));
        $this->setEmail($email)
            ->setTokenId($tokenId)
            ->setLoginId($loginId)
            ->setAccess($access)
            ->setRoleId($roleId)
            ->setExpire($expireDate);
    }

    /**
     * @return int
     */
    public function getLoginId(): int
    {
        return $this->loginId;
    }

    /**
     * @param int $loginId
     * @return Session
     */
    public function setLoginId(int $loginId): Session
    {
        $this->loginId = $loginId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Session
     */
    public function setEmail(string $email): Session
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAccess(): \DateTime
    {
        return $this->access;
    }

    /**
     * @param \DateTime $access
     * @return Session
     */
    public function setAccess(\DateTime $access): Session
    {
        $this->access = $access;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpire(): \DateTime
    {
        return $this->expire;
    }

    /**
     * @param \DateTime $expire
     * @return Session
     */
    public function setExpire(\DateTime $expire): Session
    {
        $this->expire = $expire;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenId(): string
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return Session
     */
    public function setTokenId(string $tokenId): Session
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return Session
     */
    public function setRoleId(int $roleId): Session
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function getJWT($privateKeyFile) {

        // Leggo la chiave privata
        if(!is_file($privateKeyFile))
            throw new \Exception('Private Key File is unacessible');

        $privateKey = file_get_contents($privateKeyFile);
        $payoad = (array)$this;

        // Riscrivo le date di Access ed Expire
        $payoad['access'] = $payoad['access']->format('Y-m-d H:i:s');

        // rimuovo l'expire date - delego al DB
        unset($payoad['expire']);

        // Generazione del JWT
        $jwt = JWT::encode($payoad,$privateKey);
        return $jwt;
    }

    /**
     * Ricrea la sessione dal JWT
     *
     * @param $jwt
     * @param $privateKeyFile
     * @throws \Exception
     */
    public function recreateFromJWT($jwt, $privateKeyFile) {
        // Leggo la chiave privata
        if(!is_file($privateKeyFile))
            throw new \Exception('Private Key File is unacessible');

        $privateKey = file_get_contents($privateKeyFile);
        $payload =  JWT::decode($jwt,$privateKey,['HS256']);

        $this->setAccess(new \DateTime($payload->access))
            ->setExpire(new \DateTime($payload->expire))
            ->setLoginId($payload->loginId)
            ->setTokenId($payload->tokenId)
            ->setRoleId($payload->roleId)
            ->setEmail($payload->email);
    }



}