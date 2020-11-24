<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use Carbon\Carbon;
use Nzxt\Helpers\ShopifyHelper;
use Phalcon\Di;

/**
 * Class UserTokenMapper.
 *
 * @package Nzxt\Api\Auth\Mapper
 */
class UserTokenMapper extends UsersMapper
{
    /**
     * @param Nzxt\Models\Users\Users $user
     * @param Nzxt\Api\Auth\Dto\UserToken $userTokenDto
     * @param array $context
     *
     * @return Nzxt\Api\Auth\Dto\Users
     */
    public function mapToObject($user, $userTokenDto, array $context = [])
    {
        $userTokenDto = parent::mapToObject($user, $userTokenDto, $context);

        // $expires = Di::getDefault()->getConfig()->jwt->payload->exp;
        $expires = 100;

        $userTokenDto->token = $user->getToken();
        $userTokenDto->cookies_id = $user->getId();
        $userTokenDto->time = date('Y-m-d H:i:s');
        $userTokenDto->expires = date('Y-m-d H:i:s', strtotime("+{$expires} minutes"));
        $userTokenDto->session_expires = $expires / (Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY);

        // $userTokenDto->multipasslogin = ShopifyHelper::getMultipassLogin(['email' => $user->getCleanEmail()]);

        return $userTokenDto;
    }
}
