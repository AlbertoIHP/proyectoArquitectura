<?php

namespace App\Repositories;

use App\Models\Calendar;
use InfyOm\Generator\Common\BaseRepository;

class CalendarRepository extends BaseRepository
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
        return Calendar::class;
    }
}
