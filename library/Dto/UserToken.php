<?php

namespace Gewaer\Dto;

class UserToken extends Users
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $cookies_id;

    /**
     * @var string
     */
    public $time;

    /**
     * @var string
     */
    public $expires;

    /**
     * @var string
     */
    public $session_expires;

    /**
     * @var string
     */
    public $multipasslogin;
}
