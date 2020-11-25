<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Gewaer\Models\News;
use Gewaer\Models\NewsCategories;
use Gewaer\Dto\News as NewsDto;
use Gewaer\Mapper\NewsMapper;
use Phalcon\Http\Response;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Http\RequestInterface;


// use Baka\Http\Contracts\Api\CrudBehaviorTrait;

/**
 * Class News.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class NewsController extends BaseController
{
    // use CrudBehaviorTrait;
    use ProcessOutputMapperTrait;

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $createFields = [
        'title',
        'content',
        'author_id',
        'views',
    ];

    /*
     * fields we accept to update
     *
     * @var array
     */
    protected $updateFields = [
        'title',
        'content',
        'author_id',
        'views',
    ];

    public function onConstruct(): void
    {
        $this->model = new News();
        $this->additionalSearchFields = [
            ['author_id', ':', $this->userData->getId()],
            ['is_deleted', ':', '0'],
        ];
        $this->dto = NewsDto::class;
        $this->dtoMapper = new NewsMapper();
    }

    /**
     * Given a array request from a method DTO transformed to whats is needed to
     * process it.
     *
     * @param array $request
     *
     * @return array
     */
    protected function processInput(array $request): array
    {
        $request['author_id'] = $this->userData->getId();
        $request['views'] = 0;
        return $request;
    }

    /**
     * Process the create request and records the object.
     *
     * @return ModelInterface
     *
     * @throws Exception
     */
    protected function processCreate(RequestInterface $request): ModelInterface
    {
        //process the input
        $postData = $request->getPostData();
        $request = $this->processInput($postData);
        $this->model->saveOrFail($request, $this->createFields);

        if (isset($postData['categories'])) {
            News::relateCategories($this->model->getId(), $postData['categories']);
        }

        return $this->model;
    }
}
