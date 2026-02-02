<x-layout>
  <x-slot:title>Crear Evento</x-slot:title>

  <div class="mb-6">
      <h1 class="text-3xl font-bold text-udg-blue">Crear Nuevo Evento</h1>
      <p class="text-gray-600 mt-2">Complete el formulario para registrar un nuevo evento en la agenda.</p>
  </div>

  <div class="bg-white rounded-lg shadow-md p-6">
      <form method="POST" action="{{ route('eventos.store') }}" id="eventoForm">
          @csrf

          <!-- Información Básica -->
          <div class="border-b border-gray-200 pb-6 mb-6">
              <h2 class="text-lg font-semibold text-udg-blue mb-4">Información Básica</h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Título -->
                  <div class="md:col-span-2">
                      <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">
                          Título del Evento <span class="text-udg-red">*</span>
                      </label>
                      <input type="text" 
                             name="titulo" 
                             id="titulo" 
                             value="{{ old('titulo') }}"
                             required
                             class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('titulo') border-udg-red @enderror">
                      @error('titulo')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Tipo de Evento -->
                  <div>
                      <label for="tipo_evento_id" class="block text-sm font-medium text-gray-700 mb-1">
                          Tipo de Evento <span class="text-udg-red">*</span>
                      </label>
                      <select name="tipo_evento_id" 
                              id="tipo_evento_id" 
                              required
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('tipo_evento_id') border-udg-red @enderror">
                          <option value="">Seleccione un tipo</option>
                          @foreach($tiposEvento as $tipo)
                              <option value="{{ $tipo->id }}" {{ old('tipo_evento_id') == $tipo->id ? 'selected' : '' }}>
                                  {{ $tipo->nombre }}
                              </option>
                          @endforeach
                      </select>
                      @error('tipo_evento_id')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Institución -->
                  <div>
                      <label for="institucion_id" class="block text-sm font-medium text-gray-700 mb-1">
                          Institución <span class="text-udg-red">*</span>
                      </label>
                      <select name="institucion_id" 
                              id="institucion_id" 
                              required
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('institucion_id') border-udg-red @enderror">
                          <option value="">Seleccione una institución</option>
                          @foreach($institutos as $instituto)
                              <option value="{{ $instituto->id }}" {{ old('institucion_id') == $instituto->id ? 'selected' : '' }}>
                                  {{ $instituto->nombre }}
                              </option>
                          @endforeach
                      </select>
                      @error('institucion_id')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Dependencia -->
                  <div>
                      <label for="dependencia_id" class="block text-sm font-medium text-gray-700 mb-1">
                          Dependencia <span class="text-udg-red">*</span>
                      </label>
                      <select name="dependencia_id" 
                              id="dependencia_id" 
                              required
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('dependencia_id') border-udg-red @enderror">
                          <option value="">Seleccione una dependencia</option>
                          @foreach($dependencias as $dependencia)
                              <option value="{{ $dependencia->id }}" {{ old('dependencia_id') == $dependencia->id ? 'selected' : '' }}>
                                  {{ $dependencia->nombre }}
                              </option>
                          @endforeach
                      </select>
                      @error('dependencia_id')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Otra Dependencia -->
                  <div>
                      <label for="otra_dependencia" class="block text-sm font-medium text-gray-700 mb-1">
                          Otra Dependencia (Externa)
                      </label>
                      <input type="text" 
                             name="otra_dependencia" 
                             id="otra_dependencia" 
                             value="{{ old('otra_dependencia') }}"
                             placeholder="Opcional"
                             class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('otra_dependencia') border-udg-red @enderror">
                      @error('otra_dependencia')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Organizador -->
                  <div class="md:col-span-2">
                      <label for="organizador_id" class="block text-sm font-medium text-gray-700 mb-1">
                          Organizador <span class="text-udg-red">*</span>
                      </label>
                      <select name="organizador_id" 
                              id="organizador_id" 
                              required
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('organizador_id') border-udg-red @enderror">
                          <option value="">Seleccione un organizador</option>
                          @foreach($organizadores as $organizador)
                              <option value="{{ $organizador->id }}" {{ old('organizador_id') == $organizador->id ? 'selected' : '' }}>
                                  {{ $organizador->nombre }} - {{ $organizador->telefono }}
                              </option>
                          @endforeach
                      </select>
                      @error('organizador_id')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
          </div>

          <!-- Fechas del Evento -->
          <div class="border-b border-gray-200 pb-6 mb-6">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-lg font-semibold text-udg-blue">Fechas del Evento</h2>
                  <button type="button" 
                          onclick="agregarFecha()" 
                          class="bg-udg-green hover:bg-udg-green/90 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                      Agregar Fecha
                  </button>
              </div>

              <div id="fechasContainer">
                  <!-- Las fechas se agregan dinámicamente aquí -->
              </div>

              @error('fechas')
                  <p class="mt-2 text-sm text-udg-red">{{ $message }}</p>
              @enderror
          </div>

          <!-- Notas -->
          <div class="border-b border-gray-200 pb-6 mb-6">
              <h2 class="text-lg font-semibold text-udg-blue mb-4">Notas Adicionales</h2>
              
              <div class="space-y-4">
                  <!-- Notas CTA -->
                  <div>
                      <label for="notas_cta" class="block text-sm font-medium text-gray-700 mb-1">
                          Notas CTA
                      </label>
                      <textarea name="notas_cta" 
                                id="notas_cta" 
                                rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('notas_cta') border-udg-red @enderror">{{ old('notas_cta') }}</textarea>
                      <p class="mt-1 text-xs text-gray-500">Se enviará un correo con estas notas al completar el registro.</p>
                      @error('notas_cta')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>

                  <!-- Notas Servicios Generales -->
                  <div>
                      <label for="notas_servicios_generales" class="block text-sm font-medium text-gray-700 mb-1">
                          Notas Servicios Generales
                      </label>
                      <textarea name="notas_servicios_generales" 
                                id="notas_servicios_generales" 
                                rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50 @error('notas_servicios_generales') border-udg-red @enderror">{{ old('notas_servicios_generales') }}</textarea>
                      @error('notas_servicios_generales')
                          <p class="mt-1 text-sm text-udg-red">{{ $message }}</p>
                      @enderror
                  </div>
              </div>
          </div>

          <!-- Botones -->
          <div class="flex justify-end space-x-4">
              <a href="{{ route('eventos.index') }}" 
                 class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium transition">
                  Cancelar
              </a>
              <button type="submit" 
                      class="px-6 py-2 bg-udg-red hover:bg-udg-red/90 text-white rounded-md font-medium transition">
                  Crear Evento
              </button>
          </div>
      </form>
  </div>

  @push('scripts')
  <script>
      let fechaCounter = 0;

      function agregarFecha() {
          fechaCounter++;
          const container = document.getElementById('fechasContainer');
          const fechaHTML = `
              <div class="border border-gray-200 rounded-lg p-4 mb-4 fecha-item" id="fecha-${fechaCounter}">
                  <div class="flex justify-between items-center mb-3">
                      <h3 class="font-medium text-gray-700">Fecha ${fechaCounter}</h3>
                      <button type="button" 
                              onclick="eliminarFecha(${fechaCounter})" 
                              class="text-udg-red hover:text-udg-red/80 text-sm font-medium">
                          Eliminar
                      </button>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                          <label class="block text-sm font-medium text-gray-700 mb-1">
                              Fecha <span class="text-udg-red">*</span>
                          </label>
                          <input type="date" 
                                 name="fechas[${fechaCounter}][fecha]" 
                                 required
                                 class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50">
                      </div>
                      <div>
                          <label class="block text-sm font-medium text-gray-700 mb-1">
                              Hora Inicio <span class="text-udg-red">*</span>
                          </label>
                          <input type="time" 
                                 name="fechas[${fechaCounter}][hora_inicio]" 
                                 required
                                 class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50">
                      </div>
                      <div>
                          <label class="block text-sm font-medium text-gray-700 mb-1">
                              Hora Fin <span class="text-udg-red">*</span>
                          </label>
                          <input type="time" 
                                 name="fechas[${fechaCounter}][hora_fin]" 
                                 required
                                 class="w-full border-gray-300 rounded-md shadow-sm focus:border-udg-blue focus:ring focus:ring-udg-blue focus:ring-opacity-50">
                      </div>
                  </div>
              </div>
          `;
          container.insertAdjacentHTML('beforeend', fechaHTML);
      }

      function eliminarFecha(id) {
          document.getElementById(`fecha-${id}`).remove();
      }

      // Agregar la primera fecha al cargar
      document.addEventListener('DOMContentLoaded', function() {
          agregarFecha();
      });
  </script>
  @endpush
</x-layout>