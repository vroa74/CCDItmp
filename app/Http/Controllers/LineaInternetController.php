<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use App\Models\LineaInternet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LineaInternetController extends Controller
{
    public function index(Request $request): View
    {
        $lineas = LineaInternet::query()
            ->with('edificio')
            ->when($request->string('search')->trim()->value() !== '', function ($query) use ($request) {
                $search = $request->string('search')->trim()->value();

                $query->where(function ($query) use ($search) {
                    $query->where('numero_contrato', 'like', "%{$search}%")
                        ->orWhere('numero_telefono', 'like', "%{$search}%")
                        ->orWhere('ip_publica', 'like', "%{$search}%")
                        ->orWhereHas('edificio', fn ($query) => $query->where('nombre', 'like', "%{$search}%"));
                });
            })
            ->orderByDesc('id_linea')
            ->paginate(10)
            ->withQueryString();

        return view('admin.lineas-internet.index', compact('lineas'));
    }

    public function create(): View
    {
        return view('admin.lineas-internet.create', ['edificios' => Edificio::query()->orderBy('nombre')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        LineaInternet::create($this->validated($request));

        return redirect()->route('lineas-internet.index')->with('message', 'Línea de internet creada correctamente.');
    }

    public function edit(LineaInternet $lineas_internet): View
    {
        return view('admin.lineas-internet.edit', [
            'linea' => $lineas_internet,
            'edificios' => Edificio::query()->orderBy('nombre')->get(),
        ]);
    }

    public function update(Request $request, LineaInternet $lineas_internet): RedirectResponse
    {
        $lineas_internet->update($this->validated($request));

        return redirect()->route('lineas-internet.index')->with('message', 'Línea de internet actualizada correctamente.');
    }

    public function destroy(LineaInternet $lineas_internet): RedirectResponse
    {
        $lineas_internet->delete();

        return redirect()->route('lineas-internet.index')->with('message', 'Línea de internet eliminada correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'id_edificio' => ['required', 'integer', Rule::exists('edificios', 'id_edificio')],
            'proveedor' => ['required', Rule::in(['Telmex', 'Izzi', 'MegaCable', 'totalPal', 'Starlink', 'Cable', 'Sky', 'Otros'])],
            'numero_contrato' => ['required', 'string', 'max:50'],
            'numero_telefono' => ['nullable', 'string', 'max:20'],
            'ubicacion_especifica' => ['nullable', 'string', 'max:150'],
            'modelo_modem' => ['nullable', 'string', 'max:100'],
            'ip_publica' => ['nullable', 'ip'],
            'estatus_linea' => ['required', Rule::in(['Activa', 'Inactiva', 'En_revision'])],
            'observaciones' => ['nullable', 'string'],
        ]);
    }
}
