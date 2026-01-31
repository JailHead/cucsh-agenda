<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Evento;
use App\Models\Instituto;
use App\Models\TipoEvento;
use App\Models\Dependencia;
use App\Models\Organizador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    public function index(Request $request): View
    {
        $query = Evento::with([
            'tipoEvento',
            'dependencia',
            'organizador',
            'institucion',
            'fechas'
        ]);

        // Filtro por institución
        if ($request->filled('institucion_id')) {
            $query->where('institucion_id', $request->institucion_id);
        }

        // Filtro por tipo de evento
        if ($request->filled('tipo_evento_id')) {
            $query->where('tipo_evento_id', $request->tipo_evento_id);
        }

        $eventos = $query->latest()->paginate(15);

        return view('eventos.index', compact('eventos'));
    }

    public function create(): View
    {
        $institutos = Instituto::where('activo', true)->get();
        $tiposEvento = TipoEvento::where('activo', true)->get();
        $dependencias = Dependencia::where('activo', true)->get();
        $organizadores = Organizador::where('activo', true)->get();

        return view('eventos.create', compact(
            'institutos',
            'tiposEvento',
            'dependencias',
            'organizadores'
        ));
    }

    public function store(StoreEventoRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $evento = Evento::create([
                'titulo' => $request->titulo,
                'tipo_evento_id' => $request->tipo_evento_id,
                'dependencia_id' => $request->dependencia_id,
                'otra_dependencia' => $request->otra_dependencia,
                'organizador_id' => $request->organizador_id,
                'notas_cta' => $request->notas_cta,
                'notas_servicios_generales' => $request->notas_servicios_generales,
                'institucion_id' => $request->institucion_id,
                'usuario_id' => auth()->id(),
            ]);

            // Crear fechas del evento
            if ($request->has('fechas')) {
                foreach ($request->fechas as $fecha) {
                    $evento->fechas()->create([
                        'fecha' => $fecha['fecha'],
                        'hora_inicio' => $fecha['hora_inicio'],
                        'hora_fin' => $fecha['hora_fin'],
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('eventos.show', $evento)
                ->with('success', 'Evento creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', 'Error al crear el evento: ' . $e->getMessage());
        }
    }

    public function show(Evento $evento): View
    {
        $evento->load([
            'tipoEvento',
            'dependencia',
            'organizador',
            'institucion',
            'usuario',
            'fechas' => function ($query) {
                $query->orderBy('fecha')->orderBy('hora_inicio');
            }
        ]);

        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento): View
    {
        $evento->load('fechas');
        
        $institutos = Instituto::where('activo', true)->get();
        $tiposEvento = TipoEvento::where('activo', true)->get();
        $dependencias = Dependencia::where('activo', true)->get();
        $organizadores = Organizador::where('activo', true)->get();

        return view('eventos.edit', compact(
            'evento',
            'institutos',
            'tiposEvento',
            'dependencias',
            'organizadores'
        ));
    }

    public function update(UpdateEventoRequest $request, Evento $evento): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $evento->update([
                'titulo' => $request->titulo,
                'tipo_evento_id' => $request->tipo_evento_id,
                'dependencia_id' => $request->dependencia_id,
                'otra_dependencia' => $request->otra_dependencia,
                'organizador_id' => $request->organizador_id,
                'notas_cta' => $request->notas_cta,
                'notas_servicios_generales' => $request->notas_servicios_generales,
                'institucion_id' => $request->institucion_id,
            ]);

            // Actualizar fechas: eliminar existentes y crear nuevas
            if ($request->has('fechas')) {
                $evento->fechas()->delete();
                
                foreach ($request->fechas as $fecha) {
                    $evento->fechas()->create([
                        'fecha' => $fecha['fecha'],
                        'hora_inicio' => $fecha['hora_inicio'],
                        'hora_fin' => $fecha['hora_fin'],
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('eventos.show', $evento)
                ->with('success', 'Evento actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar el evento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento): RedirectResponse
    {
        try {
            $evento->delete();

            return redirect()
                ->route('eventos.index')
                ->with('success', 'Evento eliminado exitosamente.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error al eliminar el evento: ' . $e->getMessage());
        }
    }
}