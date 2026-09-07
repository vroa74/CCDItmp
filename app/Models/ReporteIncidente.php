<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReporteIncidente extends Model
{
    protected $table = 'reportes_incidentes';

    protected $primaryKey = 'id_reporte';

    public $timestamps = false;

    protected $fillable = [
        'id_linea',
        'user_id',
        'folio_ticket_proveedor',
        'tipo_falla',
        'descripcion_problema',
        'prioridad',
        'estatus',
        'fecha_apertura',
        'fecha_cierre',
    ];

    protected $casts = [
        'fecha_apertura' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function linea(): BelongsTo
    {
        return $this->belongsTo(LineaInternet::class, 'id_linea', 'id_linea');
    }

    public function seguimientos(): HasMany
    {
        return $this->hasMany(SeguimientoSubreporte::class, 'id_reporte', 'id_reporte');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
