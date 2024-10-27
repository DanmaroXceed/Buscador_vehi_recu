<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'url',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}