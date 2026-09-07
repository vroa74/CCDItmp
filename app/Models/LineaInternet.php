<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineaInternet extends Model
{
    protected $table = 'lineas_internet';

    protected $primaryKey = 'id_linea';

    public $timestamps = false;

    protected $fillable = [
        'id_edificio',
        'proveedor',
        'numero_contrato',
        'numero_telefono',
        'ubicacion_especifica',
        'modelo_modem',
        'ip_publica',
        'estatus_linea',
        'observaciones',
    ];

    public function edificio(): BelongsTo
    {
        return $this->belongsTo(Edificio::class, 'id_edificio', 'id_edificio');
    }
}
