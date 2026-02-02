<x-layout>
  <x-slot:title>Eventos</x-slot:title>

  <div class="mb-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-udg-blue">Eventos</h1>
      
      @can('eventos.crear')
          <a href="{{ route('eventos.create') }}" 
             class="bg-udg-red hover:bg-udg-red/90 text-white px-4 py-2 rounded-lg font-medium transition">
              Nuevo Evento
          </a>
      @endcan
  </div>

  <!-- Filtros -->
  <div class="bg-white rounded-lg shadow-md p-6 mb-6">
      <form method="GET" action="{{ route('eventos.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
              <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-1">
                  Institución
              </label>
              <select name="institucion_id" id="institucion_id" 
                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50">
                  <option value="">Todas</option>
                  @foreach($institutos ?? [] as $instituto)
                      <option value="{{ $instituto->id }}" 
                              {{ request('institucion_id') == $instituto->id ? 'selected' : '' }}>
                          {{ $instituto->nombre }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div>
              <label for="tipo_evento_id" class="block text-sm font-medium text-gray-700 mb-1">
                  Tipo de Evento
              </label>
              <select name="tipo_evento_id" id="tipo_evento_id" 
                      class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50">
                  <option value="">Todos</option>
                  @foreach($tiposEvento ?? [] as $tipo)
                      <option value="{{ $tipo->id }}" 
                              {{ request('tipo_evento_id') == $tipo->id ? 'selected' : '' }}>
                          {{ $tipo->nombre }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="flex items-end">
              <button type="submit" 
                      class="w-full bg-udg-blue hover:bg-udg-blue/90 text-white px-4 py-2 rounded-md font-medium transition">
                  Filtrar
              </button>
          </div>
      </form>
  </div>

  <!-- Lista de Eventos -->
  @if($eventos->isEmpty())
      <div class="bg-white rounded-lg shadow-md p-12 text-center">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <h3 class="mt-2 text-lg font-medium text-gray-900">No hay eventos</h3>
          <p class="mt-1 text-sm text-gray-500">Comienza creando un nuevo evento.</p>
          @can('eventos.crear')
              <div class="mt-6">
                  <a href="{{ route('eventos.create') }}" 
                     class="inline-flex items-center px-4 py-2 bg-udg-red text-white rounded-md hover:bg-udg-red/90">
                      Crear Evento
                  </a>
              </div>
          @endcan
      </div>
  @else
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                      <tr>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Título
                          </th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Tipo
                          </th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Institución
                          </th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Fechas
                          </th>
                          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Organizador
                          </th>
                          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Acciones
                          </th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                      @foreach($eventos as $evento)
                          <tr class="hover:bg-gray-50">
                              <td class="px-6 py-4">
                                  <div class="text-sm font-medium text-gray-900">
                                      {{ $evento->titulo }}
                                  </div>
                              </td>
                              <td class="px-6 py-4">
                                  <span class="px-2 py-1 text-xs font-medium bg-udg-blue/10 text-udg-blue rounded">
                                      {{ $evento->tipoEvento->nombre }}
                                  </span>
                              </td>
                              <td class="px-6 py-4 text-sm text-gray-900">
                                  {{ $evento->institucion->codigo }}
                              </td>
                              <td class="px-6 py-4 text-sm text-gray-500">
                                  {{ $evento->fechas->count() }} fecha(s)
                              </td>
                              <td class="px-6 py-4 text-sm text-gray-900">
                                  {{ $evento->organizador->nombre }}
                              </td>
                              <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                  <a href="{{ route('eventos.show', $evento) }}" 
                                     class="text-udg-blue hover:text-udg-blue/80">
                                      Ver
                                  </a>
                                  
                                  @can('eventos.editar')
                                      <a href="{{ route('eventos.edit', $evento) }}" 
                                         class="text-udg-green hover:text-udg-green/80">
                                          Editar
                                      </a>
                                  @endcan
                                  
                                  @can('eventos.eliminar')
                                      <form method="POST" 
                                            action="{{ route('eventos.destroy', $evento) }}" 
                                            class="inline"
                                            onsubmit="return confirm('¿Está seguro de eliminar este evento?');">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" 
                                                  class="text-udg-red hover:text-udg-red/80">
                                              Eliminar
                                          </button>
                                      </form>
                                  @endcan
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>

          <!-- Pagination -->
          <div class="px-6 py-4 bg-gray-50">
              {{ $eventos->links() }}
          </div>
      </div>
  @endif
</x-layout>