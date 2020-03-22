<?php


namespace Systema\Service;

use Doctrine\ORM\EntityManager;
use Systema\Entities\Actionlog;

class AuditLogService
{

    protected EntityManager $orm;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $orm
     */
    public function __construct(\Doctrine\ORM\EntityManager $orm)
    {
        $this->orm = $orm;
    }

    /**
     * @param string $topic
     * @param string $verb
     * @param string $identityType
     * @param string $identityRole
     * @param int $identityId
     * @param string $identityToken
     * @param string $clientIp
     * @param string $clientUa
     * @throws \Exception
     */
    public function doAudit(string $topic,
                            string $verb,
                            string $identityType,
                            string $identityRole,
                            int $identityId,
                            string $identityToken,
                            string $clientIp,
                            string $clientUa,
                            int $responseHttpStatusCode
    )
    {

        $auditLog = new Actionlog();
        $auditLog->setClientIp($clientIp)
            ->setDate(new \DateTime('now'))
            ->setClientUa($clientUa)
            ->setTopic($topic)
            ->setVerb($verb)
            ->setIdentityId($identityId)
            ->setIdentityType($identityType)
            ->setIdentityRole($identityRole)
            ->setIdentityToken($identityToken)
            ->setResponseHttpStatusCode($responseHttpStatusCode);

        try {
            $this->orm->persist($auditLog);
            $this->orm->flush();
        }catch (\Exception $ex) {
            error_log('Auditlog save failed: ' . $ex->getTraceAsString());
        }

    }

}