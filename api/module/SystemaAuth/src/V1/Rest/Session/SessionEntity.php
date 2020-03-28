<?php
namespace SystemaAuth\V1\Rest\Session;

class SessionEntity
{
    /** @var string $tokenId */
    public string $tokenId;

    /** @var string $data JWT data */
    public string $data;

    /** @var int $loginId */
    private int $loginId = 0;

    /**
     * @return string
     */
    public function getTokenId(): string
    {
        return $this->tokenId;
    }

    /**
     * @param string $tokenId
     * @return SessionEntity
     */
    public function setTokenId(string $tokenId): SessionEntity
    {
        $this->tokenId = $tokenId;
        return $this;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return SessionEntity
     */
    public function setData(string $data): SessionEntity
    {
        $this->data = $data;
        return $this;
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
     * @return SessionEntity
     */
    public function setLoginId(int $loginId): SessionEntity
    {
        $this->loginId = $loginId;
        return $this;
    }
}

