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
class CategoriesMapper extends CustomMapper
{
    use RelationshipTrait;

    /**
     * @param Gewaer\Models\Categories $categories
     * @param Gewaer\Dto\Categories $userDto
     * @param array $context
     *
     * @return Gewaer\Dto\Categories
     */
    public function mapToObject($categories, $categoriesDto, array $context = [])
    {
        $categoriesDto->id = $categories->getId();
        $categoriesDto->category_name = rtrim($categories->category_name ?? '');

        return $categoriesDto;
    }
}
