<?php

namespace App\Http\Controllers;

use App\Models\LineaInternet;
use App\Models\ReporteIncidente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReporteIncidenteController extends Controller
{
    public function index(Request $request): View
    {
        $reportes = ReporteIncidente::query()
            ->with(['linea.edificio'])
            ->withCount('seguimientos')
            ->when($request->string('search')->trim()->value() !== '', function ($query) use ($request) {
                $search = $request->string('search')->trim()->value();

                $query->where(function ($query) use ($search) {
                    $query->where('folio_ticket_proveedor', 'like', "%{$search}%")
                        ->orWhere('descripcion_problema', 'like', "%{$search}%")
                        ->orWhereHas('linea.edificio', fn ($query) => $query->where('nombre', 'like', "%{$search}%"));
                });
            })
            ->latest('fecha_apertura')
            ->paginate(10)
            ->withQueryString();

        return view('admin.reportes-incidentes.index', compact('reportes'));
    }

    public function create(): View
    {
        return view('admin.reportes-incidentes.create', [
            'lineas' => LineaInternet::query()->with('edificio')->orderBy('numero_contrato')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $reporte = ReporteIncidente::create([
            ...$this->validated($request),
            'user_id' => $request->user()?->id,
        ]);

        return redirect()->route('reportes-incidentes.show', $reporte)->with('message', 'Reporte de incidente creado correctamente.');
    }

    public function show(ReporteIncidente $reporte): View
    {
        $reporte->load(['linea.edificio', 'seguimientos.usuario']);

        return view('admin.reportes-incidentes.show', compact('reporte'));
    }

    public function edit(ReporteIncidente $reporte): View
    {
        return view('admin.reportes-incidentes.edit', [
            'reporte' => $reporte,
            'lineas' => LineaInternet::query()->with('edificio')->orderBy('numero_contrato')->get(),
        ]);
    }

    public function update(Request $request, ReporteIncidente $reporte): RedirectResponse
    {
        $reporte->update($this->validated($request));

        return redirect()->route('reportes-incidentes.show', $reporte)->with('message', 'Reporte de incidente actualizado correctamente.');
    }

    public function destroy(ReporteIncidente $reporte): RedirectResponse
    {
        $reporte->delete();

        return redirect()->route('reportes-incidentes.index')->with('message', 'Reporte de incidente eliminado correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'id_linea' => ['required', 'integer', 'exists:lineas_internet,id_linea'],
            'folio_ticket_proveedor' => ['nullable', 'string', 'max:50'],
            'tipo_falla' => ['required', 'in:Sin_servicio,Intermitencia,Lentitud,Falla_hardware,Desconexiones,LOS (falla de fibraoptica),Otro'],
            'nombre_tecnico_proveedor' => ['nullable', 'string', 'max:100'],
            'descripcion_problema' => ['required', 'string'],
            'prioridad' => ['required', 'in:Baja,Media,Alta,Critica'],
            'estatus' => ['required', 'in:Abierto,En_proceso,Escalado,Resuelto,Cerrado'],
            'fecha_apertura' => ['required', 'date'],
            'fecha_cierre' => ['nullable', 'date', 'after_or_equal:fecha_apertura'],
        ]);
    }
}
