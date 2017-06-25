<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Maintenance",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="articulo",
 *          description="articulo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="calendar_id",
 *          description="calendar_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="maintainer_id",
 *          description="maintainer_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date"
 *      )
 * )
 */
class Maintenance extends Model
{
    use SoftDeletes;

    public $table = 'maintenances';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'articulo',
        'calendar_id',
        'maintainer_id',
        'fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'articulo' => 'string',
        'calendar_id' => 'integer',
        'maintainer_id' => 'integer',
        'fecha' => 'date'
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
    public function calendar()
    {
        return $this->belongsTo(\App\Models\Calendar::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function maintainer()
    {
        return $this->belongsTo(\App\Models\Maintainer::class);
    }
}
