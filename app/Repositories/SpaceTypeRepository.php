<?php

namespace App\Repositories;

use App\Models\SpaceType;
use InfyOm\Generator\Common\BaseRepository;

class SpaceTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'space_id',
        'precio',
        'capacidad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SpaceType::class;
    }
}
