<?php

namespace App\Repositories;

use App\Models\Worker;
use InfyOm\Generator\Common\BaseRepository;

class WorkerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'shifttype_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Worker::class;
    }
}
