<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="SpaceType",
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
 *          property="space_id",
 *          description="space_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="precio",
 *          description="precio",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="capacidad",
 *          description="capacidad",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class SpaceType extends Model
{
    use SoftDeletes;

    public $table = 'spacetypes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'space_id',
        'precio',
        'capacidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'space_id' => 'integer',
        'precio' => 'integer',
        'capacidad' => 'integer'
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
    public function space()
    {
        return $this->belongsTo(\App\Models\Space::class);
    }
}
