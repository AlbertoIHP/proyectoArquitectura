<?php

namespace App\Repositories;

use App\Models\Maintainer;
use InfyOm\Generator\Common\BaseRepository;

class MaintainerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'telefono'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Maintainer::class;
    }
}
