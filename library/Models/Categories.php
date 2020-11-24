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
class Categories extends BaseModel
{
    public function initialize()
    {
        // To the intermediate table
        $this->hasMany(
            'id',
            NewsCategories::class,
            'categorie_id'
        );

        // Many to many -> news
        $this->hasManyToMany(
            'id',
            NewsCategories::class,
            'categorie_id',
            'news_id',
            News::class,
            'id',
            [
                'reusable' => true,
                'alias'    => 'news',
            ]
        );
    }
}
