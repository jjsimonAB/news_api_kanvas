<?php

declare(strict_types=1);

namespace Gewaer\Models;


use Canvas\Models\Users;
use Gewaer\Models\BaseModel;


/**
 * Class Users.
 *
 * @package Canvas\Models
 *
 * @property Users $user
 * @property Config $config
 * @property Apps $app
 * @property Companies $defaultCompany
 * @property \Phalcon\Di $di
 */
class News extends BaseModel
{
    public function initialize()
    {
        $this->hasManyToMany(
            'id',
            NewsCategories::class,
            'news_id',
            'categorie_id',
            categories::class,
            'id',
            [
                'reusable' => true,
                'alias'    => 'categories',
            ]
        );

        $this->hasMany(
            'id',
            NewsCategories::class,
            'news_id',
            [
                'reusable' => true,
                'alias'    => 'newsCategories'
            ]
        );
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

    public static function relateCategories(object $newsModel, array $categories): void
    {
        foreach ($categories as $key => $value) {
            $newsCategories = new NewsCategories();
            $newsCategories->news_id = $newsModel->getId();
            $newsCategories->categorie_id = $value;
            $newsCategories->save();
        }
    }
}
