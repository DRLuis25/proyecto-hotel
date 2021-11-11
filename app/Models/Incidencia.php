<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Incidencia
 * @package App\Models
 * @version November 11, 2021, 4:45 am UTC
 *
 * @property \App\Models\Habitacione $habitacion
 * @property integer $habitacion_id
 * @property string $descripcion
 * @property string|\Carbon\Carbon $fecha
 * @property boolean $estado
 */
class Incidencia extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'incidencias';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'habitacion_id',
        'descripcion',
        'fecha',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'habitacion_id' => 'integer',
        'descripcion' => 'string',
        'fecha' => 'datetime',
        'estado' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'habitacion_id' => 'required',
        'descripcion' => 'required|string|max:255',
        'fecha' => 'required',
        'estado' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function habitacion()
    {
        return $this->belongsTo(\App\Models\Habitacione::class, 'habitacion_id');
    }
}
