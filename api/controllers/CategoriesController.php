<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Gewaer\Models\Categories;
use Gewaer\Dto\Categories as CategoriesDto;
use Gewaer\Mapper\CategoriesMapper;

// use Baka\Http\Contracts\Api\CrudBehaviorTrait;

/**
 * Class BaseController.
 *
 * @package Canvas\Api\Controllers
 *
 */
class CategoriesController extends BaseController
{
    // use CrudBehaviorTrait;
    use ProcessOutputMapperTrait;

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $createFields = [
        'category_name'
    ];

    /*
     * fields we accept to update
     *
     * @var array
     */
    protected $updateFields = [
        'category_name'
    ];


    public function onConstruct()
    {
        $this->model = new Categories();
        $this->dto = CategoriesDto::class;
        $this->dtoMapper = new CategoriesMapper();
    }
}
