<?php

namespace App\Repositories;

use App\Models\Payment;
use InfyOm\Generator\Common\BaseRepository;

class PaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'mes',
        'anio',
        'monto',
        'pagado'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Payment::class;
    }
}
