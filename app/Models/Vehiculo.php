<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'fecha_liberacion',
        'corporacion_asegura',
        'elemento_asegura',
        'grua',
        'serie',
        'placas',
        'marca',
        'submarca',
        'modelo',
        'color',
        'mp',
        'cui',
        'observaciones',
        'estado',
        'area',
        'fecha_parte',
        'tipo_v',
        'origen',
        'municipio',
        'calle',
        'fecha_robo',
        'rec_mismo_dia',
        'alt_rem',
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
