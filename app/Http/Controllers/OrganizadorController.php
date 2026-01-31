<?php

namespace App\Http\Controllers;

use App\Models\Organizador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $organizadores = Organizador::latest()->paginate(15);

        return view('organizadores.index', compact('organizadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('organizadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'activo' => ['boolean'],
        ]);

        $organizador = Organizador::create($validated);

        return redirect()
            ->route('organizadores.index')
            ->with('success', 'Organizador creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizador $organizador): View
    {
        $organizador->load('eventos');

        return view('organizadores.show', compact('organizador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizador $organizador): View
    {
        return view('organizadores.edit', compact('organizador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organizador $organizador): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'activo' => ['boolean'],
        ]);

        $organizador->update($validated);

        return redirect()
            ->route('organizadores.index')
            ->with('success', 'Organizador actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizador $organizador): RedirectResponse
    {
        try {
            $organizador->delete();

            return redirect()
                ->route('organizadores.index')
                ->with('success', 'Organizador eliminado exitosamente.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'No se puede eliminar el organizador porque tiene eventos asociados.');
        }
    }
}
