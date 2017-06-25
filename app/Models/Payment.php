<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Payment",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="mes",
 *          description="mes",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="anio",
 *          description="anio",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="monto",
 *          description="monto",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="pagado",
 *          description="pagado",
 *          type="string"
 *      )
 * )
 */
class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'mes',
        'anio',
        'monto',
        'pagado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'mes' => 'integer',
        'anio' => 'integer',
        'monto' => 'integer',
        'pagado' => 'string'
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
