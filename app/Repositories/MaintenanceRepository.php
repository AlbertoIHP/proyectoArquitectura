<?php

namespace App\Repositories;

use App\Models\Maintenance;
use InfyOm\Generator\Common\BaseRepository;

class MaintenanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'articulo',
        'calendar_id',
        'maintainer_id',
        'fecha'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Maintenance::class;
    }
}
