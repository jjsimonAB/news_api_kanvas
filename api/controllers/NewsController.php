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
            $this->relateCategories($this->model->getId(), $postData['categories']);
        }

        return $this->model;
    }

    /**
     * Creates the relationship between news and categories
     *
     * @return void
     * 
     * @param int $id
     * @param array $categories
     *
     */

    private function relateCategories(int $id, array $categories): void
    {
        foreach ($categories as $key => $value) {
            $newsCategories = new NewsCategories();
            $newsCategories->news_id = $id;
            $newsCategories->categorie_id = $value;
            $newsCategories->save();
        }
    }

    /**
     * Get the record by its primary key.
     *
     * @param mixed $id
     *
     * @throws Exception
     *
     * @return Response
     */

    public function getById($id): Response
    {
        $record = $this->getRecordById($id);
        return $this->response($this->processOutput($record));
    }

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
}
