<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

// use Baka\Auth\Models\Users;
use Gewaer\Models\Users;
use Canvas\Api\Controllers\AuthController as CanvasAuthController;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Gewaer\Mapper\UserTokenMapper;
use Gewaer\Api\Controllers\BaseController;
use Canvas\Validation as CanvasValidation;
use Exception;

/**
 * Class AuthController
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Users $userData
 * @property Request $request
 * @property Config $config
 * @property \Baka\Mail\Message $mail
 * @property Apps $app
 */
class AuthController extends CanvasAuthController
{
 
}
