<?php

namespace Gewaer\Api\Controllers;

use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Canvas\Api\Controllers\BaseController;
use Gewaer\Models\Users;

class UsersController extends BaseController
{
    use ProcessOutputMapperTrait;

    /**
     * fields we accept to create
     *
     * @var array
     */
    protected $createFields = [
        'username',
        'email',
        'password'
    ];

    /**
     * fields we accept to update
     *
     * @var array
     */
    protected $updateFields = [
        'username',
        'email'
    ];

    /**
     * fields we accept to update
     *
     * @var array
     */
    public function onConstruct()
    {
        $this->model = new Users();
        $this->dto = UserDto::class;
        // $this->dtoMapper = new UserMapper();
    }
}
