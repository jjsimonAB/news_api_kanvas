<?php

namespace Page;

class Data
{
    public static $loginUrl = '/v1/auth';
    public static $usersUrl = '/v1/users';
    public static $statusUrl = '/v1/status';

    /**
     * @return array
     */
    public static function loginJson()
    {
        return [
            'email' => 'test_user@test.com',
            'password' => 'bakatest123567',
        ];
    }
}
