<?php

namespace App\Repositories;

use App\Models\Apartment;
use InfyOm\Generator\Common\BaseRepository;

class ApartmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'building_id',
        'numero',
        'area'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Apartment::class;
    }
}
