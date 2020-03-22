<?php


namespace Systema\Service;


use Doctrine\ORM\EntityManager;
use Laminas\Crypt\Password\Bcrypt;
use Systema\Authentication\Session;
use Systema\Entities\LocalType;
use Systema\Entities\Login;
use Systema\Entities\LoginHasRole;
use Systema\Entities\Role;
use Systema\Entities\Token;
use SystemaAuth\V1\Rest\Login\LoginEntity;
use function PHPUnit\Framework\isEmpty;

class SystemaService
{

    public const ERR_EMAIL_ALREADY_USED = -1;
    public const ERR_DATABASE_ERR = -2;
    public const ERR_EMAIL_NOT_FOUND = -3;
    public const ERR_INVALID_CREDENTIALS = -4;

    public const ERR_TOKEN_NOT_FOUND = -5;
    public const ERR_TOKEN_EXPIRED = -6;

    private \Doctrine\ORM\EntityManager $orm;
    private string $privateKeyFile;
    private int $sessionTTL = 3600;
    private int $newUserRoleId = 3;

    /**
     * SystemaService constructor.
     *
     * @param \Doctrine\ORM\EntityManager $orm
     * @param string $privateKeyFile
     * @param int $sessionTTL
     */
    public function __construct(\Doctrine\ORM\EntityManager $orm, string $privateKeyFile, int $sessionTTL, $newUserRoleId)
    {
        $this->orm = $orm;
        $this->privateKeyFile = $privateKeyFile;
        $this->sessionTTL = $sessionTTL;
        $this->newUserRoleId = $newUserRoleId;
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
     * Crea un nuovo utente/login
     *
     * @param string $email
     * @param string $password
     * @return Login
     * @throws \Exception
     */
    public function registerNewLogin(string $email, string $password): Login
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
                // Associazione Ruoli
                $defaultUserRole = $this->getORM()->find(Role::class,$this->newUserRoleId);
                $login->setRoles([$defaultUserRole]);
                $this->getORM()->persist($login);
                $this->getORM()->flush();

                return $login;
            }catch (\Exception $ex ) {
                throw new \Exception($ex->getMessage(),self::ERR_DATABASE_ERR);
            }


        }else{
            throw new \Exception('Email already used',self::ERR_EMAIL_ALREADY_USED);
        }
    }

    /**
     * Effettua la verifica delle credenziali fornite
     *
     * @param string $email
     * @param string $password
     * @return Login
     * @throws \Exception
     */
    public function validateLogin(string $email, string $password): Login
    {
        $loginRepo = $this->getORM()->getRepository(Login::class);
        $foundLogins = $loginRepo->findBy(['email'=>$email]);

        if (count($foundLogins) != 1) {
            throw new \Exception('Email is not registered',self::ERR_EMAIL_NOT_FOUND);
        }

        /** @var Login $foundLogin */
        $foundLogin = $foundLogins[0];
        $bcrypt = new Bcrypt();
        $checkPassword = $bcrypt->verify($password,$foundLogin->getPassword());

        if(!$checkPassword)
            throw new \Exception('Invalid credentials',self::ERR_INVALID_CREDENTIALS);
        else
            return $foundLogin;
    }


    /**
     * Genera il Token a partire dalla Sessione
     *
     * @param Session $session
     * @return Token
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function createToken(Session $session): Token {

        // Genero TokenID
        $tokenPart1 = md5($session->getLoginId());
        $tokenPart2 = md5(time());

        $tokenId = (substr($tokenPart1,0,strlen($tokenPart1)/2)) .
            (substr($tokenPart2, strlen($tokenPart2)/2, strlen($tokenPart2)/2));

        $check = $this->getORM()->find(Token::class, $tokenId);

        while ($check instanceof Token) {
            $tokenPart2 = md5(time());
            $tokenId = (substr($tokenPart1,0,strlen($tokenPart1)/2)) .
                (substr($tokenPart2, strlen($tokenPart2)/2, strlen($tokenPart2)/2));
            $check = $this->getORM()->find(Token::class, $tokenId);
        }

        $login = $this->getORM()->find(Login::class, $session->getLoginId());

        // Genero il JWT
        $session->setTokenId($tokenId);
        $jwt = $session->getJWT($this->privateKeyFile);


        $token = new Token();
        $token->setTokenId($tokenId)
            ->setData($jwt)
            ->setLogin($login)
            ->setCreationDate($session->getAccess())
            ->setExpireDate($session->getExpire());

        try {
            $this->getORM()->persist($token);
            $this->getORM()->flush();
            return $token;
        }catch( \Exception $ex ){
            throw new \Exception('Error during Token generation:' . $ex->getMessage());
        }
    }

    /**
     *
     *
     * @param string $tokenId
     * @return Token
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function checkToken(string $tokenId): Token
    {
        /** @var Token $token */
        $token = $this->getORM()->find(Token::class, $tokenId);

        if ($token instanceof Token) {
            $now = new \DateTime('now');
            if ($now > $token->getExpireDate())
                throw new \Exception('Token is expired', self::ERR_TOKEN_EXPIRED);

            return $token;
        } else {
            throw new \Exception('Token not found',self::ERR_TOKEN_NOT_FOUND);
        }
    }

    /**
     * Aggiorna la scadenza del token
     *
     * @param $tokenId
     * @return object|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function refreshToken($tokenId)
    {
        $token = $this->getORM()->find(Token::class, $tokenId);
        if ($token instanceof Token) {
            // Rinnovo il token
            $expireDate = new \DateTime($token->getExpireDate()->format('Y-m-d H:i:s'));
            $expireDate->add(new \DateInterval('PT'.$this->sessionTTL.'S'));
            $token->setExpireDate($expireDate);

            try {
                $this->getORM()->persist($token);
                $this->getORM()->flush();
                return $token;
            }catch (\Exception $ex ){
                throw new \Exception('General error in Token saving',self::ERR_TOKEN_NOT_FOUND);
            }
        } else {
            throw new \Exception('Token not found',self::ERR_TOKEN_NOT_FOUND);
        }

        //$token->setExpireDate();
    }

}