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
class NewsCategories extends BaseModel
{

    public function initialize()
    {
        $this->belongsTo(
            'news_id',
            News::class,
            'id',
            [
                'reusable' => true,
                'alias'    => 'news'
            ]
        );

        $this->belongsTo(
            'categorie_id',
            Categories::class,
            'id',
            [
                'reusable' => true,
                'alias'    => 'categories'
            ]
        );
    }
}
