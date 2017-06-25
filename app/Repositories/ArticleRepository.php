<?php

namespace App\Repositories;

use App\Models\Article;
use InfyOm\Generator\Common\BaseRepository;

class ArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'space_id',
        'cantidad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article::class;
    }
}
