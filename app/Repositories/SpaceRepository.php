<?php

namespace App\Repositories;

use App\Models\Space;
use InfyOm\Generator\Common\BaseRepository;

class SpaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'building_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Space::class;
    }
}
