<?php

namespace App\Repositories;

use App\Models\Assistance;
use InfyOm\Generator\Common\BaseRepository;

class AssistanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'hora_entrada',
        'reemplazo',
        'worker_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Assistance::class;
    }
}
