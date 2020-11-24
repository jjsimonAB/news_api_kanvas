<?php

declare(strict_types=1);

namespace Gewaer\Contracts;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha512;
use Lcobucci\JWT\ValidationData;
use Phalcon\Security\Random;

/**
 * Trait For JWT User Auth Token.
 *
 * @package Gewaer\Traits
 *
 * @property Users $user
 * @property Config $config
 * @property Request $request
 * @property Auth $auth
 * @property \Phalcon\Di $di
 *
 */
trait AuthTokenTrait
{
    /**
     * Returns the string token.
     *
     * @return string
     * @throws ModelException
     */
    public function getToken(): string
    {
        $random = new Random();
        $sessionId = $random->uuid();

        $signer = new Sha512();
        $builder = new Builder();
        $token = $builder
            ->setIssuer(getenv('TOKEN_AUDIENCE'))
            ->setAudience(getenv('TOKEN_AUDIENCE'))
            ->setId($sessionId, true)
            ->setIssuedAt(time())
            ->setNotBefore(time() + 500)
            ->setExpiration(time() + $this->di->getConfig()->jwt->payload->exp)
            ->set('sessionId', $sessionId)
            ->set('email', $this->getEmail())
            ->sign($signer, getenv('TOKEN_PASSWORD'))
            ->getToken();

        return  $token->__toString();
    }

    /**
     * Returns the ValidationData object for this record (JWT).
     *
     * @return ValidationData
     * @throws ModelException
     */
    public static function getValidationData(string $id): ValidationData
    {
        $validationData = new ValidationData();
        $validationData->setIssuer(getenv('TOKEN_AUDIENCE'));
        $validationData->setAudience(getenv('TOKEN_AUDIENCE'));
        $validationData->setId($id);
        $validationData->setCurrentTime(time() + 500);

        return $validationData;
    }
}
