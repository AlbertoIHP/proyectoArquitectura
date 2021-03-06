<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Expense",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="building_id",
 *          description="building_id",
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
 *          property="descripcion",
 *          description="descripcion",
 *          type="string"
 *      )
 * )
 */
class Expense extends Model
{
    use SoftDeletes;

    public $table = 'expenses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'building_id',
        'monto',
        'mes',
        'anio',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'building_id' => 'integer',
        'monto' => 'integer',
        'mes' => 'integer',
        'anio' => 'integer',
        'descripcion' => 'string'
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
    public function building()
    {
        return $this->belongsTo(\App\Models\Building::class);
    }
}
