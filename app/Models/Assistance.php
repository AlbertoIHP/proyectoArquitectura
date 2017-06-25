<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Assistance",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="hora_entrada",
 *          description="hora_entrada",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="reemplazo",
 *          description="reemplazo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="worker_id",
 *          description="worker_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Assistance extends Model
{
    use SoftDeletes;

    public $table = 'assistances';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'fecha',
        'hora_entrada',
        'reemplazo',
        'worker_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'date',
        'hora_entrada' => 'integer',
        'reemplazo' => 'string',
        'worker_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function worker()
    {
        return $this->belongsTo(\App\Models\Worker::class);
    }
}
