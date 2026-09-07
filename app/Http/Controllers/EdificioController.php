<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EdificioController extends Controller
{
    public function index(Request $request): View
    {
        $edificios = Edificio::query()
            ->when($request->string('search')->trim()->value() !== '', function ($query) use ($request) {
                $search = $request->string('search')->trim()->value();

                $query->where(function ($query) use ($search) {
                    $query->where('nombre', 'like', "%{$search}%")
                        ->orWhere('direccion', 'like', "%{$search}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('admin.edificios.index', compact('edificios'));
    }

    public function create(): View
    {
        return view('admin.edificios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Edificio::create($this->validated($request));

        return redirect()->route('edificios.index')->with('message', 'Edificio creado correctamente.');
    }

    public function edit(Edificio $edificio): View
    {
        return view('admin.edificios.edit', compact('edificio'));
    }

    public function update(Request $request, Edificio $edificio): RedirectResponse
    {
        $edificio->update($this->validated($request));

        return redirect()->route('edificios.index')->with('message', 'Edificio actualizado correctamente.');
    }

    public function destroy(Edificio $edificio): RedirectResponse
    {
        try {
            $edificio->delete();
        } catch (QueryException) {
            return redirect()->route('edificios.index')->with('error', 'No se puede eliminar el edificio porque tiene líneas de internet asociadas.');
        }

        return redirect()->route('edificios.index')->with('message', 'Edificio eliminado correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'direccion' => ['nullable', 'string'],
        ]);
    }
}
