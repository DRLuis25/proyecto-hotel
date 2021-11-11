<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Cliente
 * @package App\Models
 * @version November 11, 2021, 4:46 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $registros
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property string $dni
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $tipo
 */
class Cliente extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'clientes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'telefono',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dni' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'telefono' => 'string',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'dni' => 'required|string|max:255',
        'nombres' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'tipo' => 'required|string|max:1',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function registros()
    {
        return $this->hasMany(\App\Models\Registro::class, 'cliente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function servicios()
    {
        return $this->hasMany(\App\Models\Servicio::class, 'cliente_id');
    }
}
