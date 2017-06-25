<?php

namespace App\Repositories;

use App\Models\Reservation;
use InfyOm\Generator\Common\BaseRepository;

class ReservationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'user_id',
        'space_id',
        'fecha',
        'pagado',
        'cliente'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Reservation::class;
    }
}
