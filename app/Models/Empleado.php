<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Empleado
 * @package App\Models
 * @version November 11, 2021, 4:49 am UTC
 *
 * @property \App\Models\Area $area
 * @property \App\Models\Cargo $cargo
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property integer $area_id
 * @property integer $cargo_id
 * @property string $nombres
 * @property string $apellidos
 */
class Empleado extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'empleados';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'area_id',
        'cargo_id',
        'nombres',
        'apellidos'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'area_id' => 'integer',
        'cargo_id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'area_id' => 'required',
        'cargo_id' => 'required',
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function area()
    {
        return $this->belongsTo(\App\Models\Area::class, 'area_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cargo()
    {
        return $this->belongsTo(\App\Models\Cargo::class, 'cargo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function servicios()
    {
        return $this->hasMany(\App\Models\Servicio::class, 'empleado_id');
    }
}
