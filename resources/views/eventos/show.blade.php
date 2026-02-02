<x-layout>
  <x-slot:title>{{ $evento->titulo }}</x-slot:title>

  <div class="mb-6">
      <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-udg-blue">{{ $evento->titulo }}</h1>
          <div class="space-x-2">
              @can('eventos.editar')
                  <a href="{{ route('eventos.edit', $evento) }}" 
                     class="inline-flex items-center px-4 py-2 bg-udg-green hover:bg-udg-green/90 text-white rounded-lg font-medium transition">
                      Editar
                  </a>
              @endcan
              
              <a href="{{ route('eventos.index') }}" 
                 class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition">
                  Volver
              </a>
          </div>
      </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Información Principal -->
      <div class="lg:col-span-2 space-y-6">
          <!-- Detalles del Evento -->
          <div class="bg-white rounded-lg shadow-md p-6">
              <h2 class="text-xl font-semibold text-udg-blue mb-4 border-b pb-2">Información del Evento</h2>
              
              <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                      <dt class="text-sm font-medium text-gray-500">Tipo de Evento</dt>
                      <dd class="mt-1">
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-udg-blue/10 text-udg-blue">
                              {{ $evento->tipoEvento->nombre }}
                          </span>
                      </dd>
                  </div>

                  <div>
                      <dt class="text-sm font-medium text-gray-500">Institución</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ $evento->institucion->nombre }}</dd>
                  </div>

                  <div>
                      <dt class="text-sm font-medium text-gray-500">Dependencia</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ $evento->dependencia->nombre }}</dd>
                  </div>

                  @if($evento->otra_dependencia)
                  <div>
                      <dt class="text-sm font-medium text-gray-500">Dependencia Externa</dt>
                      <dd class="mt-1 text-sm text-gray-900">{{ $evento->otra_dependencia }}</dd>
                  </div>
                  @endif

                  <div class="md:col-span-2">
                      <dt class="text-sm font-medium text-gray-500">Organizador</dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $evento->organizador->nombre }}
                          @if($evento->organizador->telefono)
                              <span class="text-gray-500">• {{ $evento->organizador->telefono }}</span>
                          @endif
                          @if($evento->organizador->email)
                              <span class="text-gray-500">• {{ $evento->organizador->email }}</span>
                          @endif
                      </dd>
                  </div>

                  <div class="md:col-span-2">
                      <dt class="text-sm font-medium text-gray-500">Registrado por</dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $evento->usuario->name }} • {{ $evento->created_at->format('d/m/Y H:i') }}
                      </dd>
                  </div>
              </dl>
          </div>

          <!-- Fechas -->
          <div class="bg-white rounded-lg shadow-md p-6">
              <h2 class="text-xl font-semibold text-udg-blue mb-4 border-b pb-2">Fechas del Evento</h2>
              
              <div class="space-y-3">
                  @foreach($evento->fechas as $fecha)
                      <div class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                          <div class="flex-shrink-0">
                              <div class="w-16 h-16 bg-udg-blue/10 rounded-lg flex flex-col items-center justify-center">
                                  <span class="text-2xl font-bold text-udg-blue">
                                      {{ $fecha->fecha->format('d') }}
                                  </span>
                                  <span class="text-xs text-gray-600 uppercase">
                                      {{ $fecha->fecha->format('M') }}
                                  </span>
                              </div>
                          </div>
                          <div class="ml-4">
                              <p class="text-sm font-medium text-gray-900">
                                  {{ $fecha->fecha->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                              </p>
                              <p class="text-sm text-gray-500">
                                  {{ $fecha->hora_inicio->format('H:i') }} - {{ $fecha->hora_fin->format('H:i') }}
                              </p>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>

          <!-- Notas -->
          @if($evento->notas_cta || $evento->notas_servicios_generales)
          <div class="bg-white rounded-lg shadow-md p-6">
              <h2 class="text-xl font-semibold text-udg-blue mb-4 border-b pb-2">Notas Adicionales</h2>
              
              @if($evento->notas_cta)
              <div class="mb-4">
                  <h3 class="text-sm font-medium text-gray-700 mb-2">Notas CTA</h3>
                  <div class="p-4 bg-yellow-50 border-l-4 border-udg-yellow rounded-r">
                      <p class="text-sm text-gray-700 whitespace-pre-line">{{ $evento->notas_cta }}</p>
                  </div>
              </div>
              @endif

              @if($evento->notas_servicios_generales)
              <div>
                  <h3 class="text-sm font-medium text-gray-700 mb-2">Notas Servicios Generales</h3>
                  <div class="p-4 bg-blue-50 border-l-4 border-udg-blue rounded-r">
                      <p class="text-sm text-gray-700 whitespace-pre-line">{{ $evento->notas_servicios_generales }}</p>
                  </div>
              </div>
              @endif
          </div>
          @endif
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
          <!-- Acciones Rápidas -->
          <div class="bg-white rounded-lg shadow-md p-6">
              <h3 class="text-lg font-semibold text-udg-blue mb-4">Acciones</h3>
              <div class="space-y-2">
                  @can('eventos.editar')
                      <a href="{{ route('eventos.edit', $evento) }}" 
                         class="block w-full text-center px-4 py-2 bg-udg-green hover:bg-udg-green/90 text-white rounded-md font-medium transition">
                          Editar Evento
                      </a>
                  @endcan

                  <button onclick="window.print()" 
                          class="block w-full text-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 font-medium transition">
                      Imprimir
                  </button>

                  @can('eventos.eliminar')
                      <form method="POST" 
                            action="{{ route('eventos.destroy', $evento) }}"
                            onsubmit="return confirm('¿Está seguro de eliminar este evento? Esta acción no se puede deshacer.');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" 
                                  class="block w-full text-center px-4 py-2 bg-udg-red hover:bg-udg-red/90 text-white rounded-md font-medium transition">
                              Eliminar Evento
                          </button>
                      </form>
                  @endcan
              </div>
          </div>

          <!-- Resumen -->
          <div class="bg-white rounded-lg shadow-md p-6">
              <h3 class="text-lg font-semibold text-udg-blue mb-4">Resumen</h3>
              <dl class="space-y-3">
                  <div>
                      <dt class="text-xs font-medium text-gray-500 uppercase">Total de Fechas</dt>
                      <dd class="mt-1 text-2xl font-semibold text-udg-blue">{{ $evento->fechas->count() }}</dd>
                  </div>
                  <div>
                      <dt class="text-xs font-medium text-gray-500 uppercase">Primera Fecha</dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $evento->fechas->first()->fecha->format('d/m/Y') }}
                      </dd>
                  </div>
                  <div>
                      <dt class="text-xs font-medium text-gray-500 uppercase">Última Fecha</dt>
                      <dd class="mt-1 text-sm text-gray-900">
                          {{ $evento->fechas->last()->fecha->format('d/m/Y') }}
                      </dd>
                  </div>
              </dl>
          </div>
      </div>
  </div>
</x-layout>