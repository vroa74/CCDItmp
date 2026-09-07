<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeguimientoSubreporte extends Model
{
    protected $table = 'seguimiento_subreportes';

    protected $primaryKey = 'id_subreporte';

    public $timestamps = false;

    protected $fillable = [
        'id_reporte',
        'user_id',
        'folio_subreporte_proveedor',
        'fecha_registro',
        'comentarios',
        'nombre_tecnico_proveedor',
        'proxima_accion',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    public function reporte(): BelongsTo
    {
        return $this->belongsTo(ReporteIncidente::class, 'id_reporte', 'id_reporte');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
