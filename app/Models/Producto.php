<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Producto
 * @package App\Models
 * @version November 11, 2021, 5:02 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property string $nombre
 * @property string $descripcion
 * @property number $precio
 * @property integer $stock
 */
class Producto extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'productos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'precio' => 'decimal:2',
        'stock' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function servicios()
    {
        return $this->belongsToMany(\App\Models\Servicio::class, 'servicio_detalles');
    }
}
