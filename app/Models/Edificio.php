<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Edificio extends Model
{
    protected $table = 'edificios';

    protected $primaryKey = 'id_edificio';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'direccion',
    ];

    protected $casts = [
        'creado_en' => 'datetime',
    ];

    public function lineasInternet(): HasMany
    {
        return $this->hasMany(LineaInternet::class, 'id_edificio', 'id_edificio');
    }
}
