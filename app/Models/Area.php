<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Area
 * @package App\Models
 * @version November 11, 2021, 4:49 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 * @property string $descripcion
 * @property string $actividad
 */
class Area extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'areas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion',
        'actividad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string',
        'actividad' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required|string|max:255',
        'actividad' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'area_id');
    }
}
