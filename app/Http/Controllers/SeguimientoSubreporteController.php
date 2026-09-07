<?php

namespace App\Http\Controllers;

use App\Models\ReporteIncidente;
use App\Models\SeguimientoSubreporte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeguimientoSubreporteController extends Controller
{
    public function create(ReporteIncidente $reporte): View
    {
        return view('admin.seguimientos-subreportes.create', compact('reporte'));
    }

    public function store(Request $request, ReporteIncidente $reporte): RedirectResponse
    {
        $reporte->seguimientos()->create([
            ...$this->validated($request),
            'user_id' => $request->user()?->id,
        ]);

        return redirect()->route('reportes-incidentes.show', $reporte)->with('message', 'Seguimiento agregado correctamente.');
    }

    public function edit(ReporteIncidente $reporte, SeguimientoSubreporte $seguimiento): View
    {
        abort_unless($seguimiento->id_reporte === $reporte->id_reporte, 404);

        return view('admin.seguimientos-subreportes.edit', compact('reporte', 'seguimiento'));
    }

    public function update(Request $request, ReporteIncidente $reporte, SeguimientoSubreporte $seguimiento): RedirectResponse
    {
        abort_unless($seguimiento->id_reporte === $reporte->id_reporte, 404);
        $seguimiento->update($this->validated($request));

        return redirect()->route('reportes-incidentes.show', $reporte)->with('message', 'Seguimiento actualizado correctamente.');
    }

    public function destroy(ReporteIncidente $reporte, SeguimientoSubreporte $seguimiento): RedirectResponse
    {
        abort_unless($seguimiento->id_reporte === $reporte->id_reporte, 404);
        $seguimiento->delete();

        return redirect()->route('reportes-incidentes.show', $reporte)->with('message', 'Seguimiento eliminado correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'folio_subreporte_proveedor' => ['nullable', 'string', 'max:50'],
            'fecha_registro' => ['required', 'date'],
            'comentarios' => ['required', 'string'],
            'nombre_tecnico_proveedor' => ['nullable', 'string', 'max:100'],
            'proxima_accion' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
