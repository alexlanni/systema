<?php


namespace Systema\Service;


use Doctrine\ORM\EntityManager;
use Laminas\Crypt\Password\Bcrypt;
use Systema\Entities\LocalType;
use Systema\Entities\Login;
use Systema\Entities\Role;
use SystemaAuth\V1\Rest\Login\LoginEntity;
use function PHPUnit\Framework\isEmpty;

class SystemaService
{

    public const ERR_EMAIL_ALREADY_USED = -1;
    public const ERR_DATABASE_ERR = -2;

    private \Doctrine\ORM\EntityManager $orm;

    /**
     * PingResource constructor.
     * @param \Doctrine\ORM\EntityManager $orm
     */
    public function __construct(\Doctrine\ORM\EntityManager $orm)
    {
        $this->orm = $orm;
    }

    /**
     * Ritorna l'ORM utilizzato dal Servizio
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getORM(): EntityManager
    {
        return $this->orm;
    }

    /**
     * TODO: spostare in Repository
     * Ottine la Query per il FetchAll dei LocalType
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchLocalTypesQuery($params=[])
    {
        $localTypeRepo = $this->getORM()
            ->getRepository(LocalType::class);
        $queryBuilder = $localTypeRepo->createQueryBuilder('lt');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['localTypeId'])) {
            $queryBuilder->andWhere('lt.localTypeId = :localTypeId')
            ->setParameter('localTypeId', $params['localTypeId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }


    /**
     * TODO: spostare in Repository
     * Ottine la Query per il FetchAll dei Role
     *
     * @param array $params
     * @return \Doctrine\ORM\Query
     */
    public function getFetchAllRoleQuery($params=[])
    {
        $repoRoles = $this->getORM()->getRepository(Role::class);
        $queryBuilder = $repoRoles->createQueryBuilder('ro');
        $queryBuilder->andWhere('1 = 1');
        if (!empty($params['roleId'])) {
            $queryBuilder->andWhere('ro.roleId = :roleId')
                ->setParameter('roleId', $params['roleId'], \PDO::PARAM_INT );
        }
        return $queryBuilder->getQuery();
    }


    /**
     * Crea un nuovo utente/login
     *
     * @param string $email
     * @param string $password
     * @return LoginEntity
     * @throws \Exception
     */
    public function registerNewLogin(string $email, string $password)
    {
        $loginRepo = $this->getORM()->getRepository(Login::class);

        $emailAlreadyExists = $loginRepo->findBy(['email'=>$email]);

        if (count($emailAlreadyExists) == 0 ) {
            $bcrypt = new Bcrypt();
            $securePass = $bcrypt->create($password);

            $login = new Login();
            $login->setEmail($email)
                ->setEnabled(1)
                ->setPassword($securePass);

            try {
                $this->getORM()->persist($login);
                $this->getORM()->flush();
            }catch (\Exception $ex ) {
                throw new \Exception($ex->getMessage(),self::ERR_DATABASE_ERR);
            }

            return $login;
        }else{
            throw new \Exception('Email already used',self::ERR_EMAIL_ALREADY_USED);
        }

    }

}