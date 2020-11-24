<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;

/**
 * Class UsersMapper.
 *
 * @package Gewaer\Mapper\Mapper
 */
class UsersMapper extends CustomMapper
{
    /**
     * @param Gewaer\Users\Users $user
     * @param Gewaer\Dto\Users $userDto
     * @param array $context
     *
     * @return Gewaer\Dto\Users
     */
    public function mapToObject($user, $userDto, array $context = [])
    {
        $userDto->id = $user->getId();
        $userDto->username = rtrim($user->username ?? '');
        $userDto->email = $user->getCleanEmail();
        $userDto->location = rtrim($user->location ?? '');

        return $userDto;
    }
}
