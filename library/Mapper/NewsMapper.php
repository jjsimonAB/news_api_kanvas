<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Canvas\Contracts\Mapper\RelationshipTrait;

/**
 * Class UsersMapper.
 *
 * @package Gewaer\Mapper\Mapper
 */
class NewsMapper extends CustomMapper
{
    use RelationshipTrait;

    /**
     * @param Gewaer\Models\Users $user
     * @param Gewaer\Dto\News $userDto
     * @param array $context
     *
     * @return Gewaer\Dto\News
     */
    public function mapToObject($news, $newsDto, array $context = [])
    {
        $newsDto->id = $news->getId();
        $newsDto->title = rtrim($news->title ?? '');
        $newsDto->content = $news->content ?? '';
        $newsDto->author_id = $news->author_id ?? '';
        $newsDto->views = $news->views;
        $newsDto->categories = $news->categories ?? [];

        $this->getRelationships($news, $newsDto, $context);

        return $newsDto;
    }
}
