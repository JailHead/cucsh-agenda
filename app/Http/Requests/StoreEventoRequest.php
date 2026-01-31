<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Verificar que el usuario tenga permiso para crear eventos
        return $this->user()->can('eventos.crear');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'tipo_evento_id' => ['required', 'exists:tipos_evento,id'],
            'dependencia_id' => ['required', 'exists:dependencias,id'],
            'otra_dependencia' => ['nullable', 'string', 'max:255'],
            'organizador_id' => ['required', 'exists:organizadores,id'],
            'notas_cta' => ['nullable', 'string'],
            'notas_servicios_generales' => ['nullable', 'string'],
            'institucion_id' => ['required', 'exists:instituciones,id'],
            
            // Validación de fechas del evento
            'fechas' => ['required', 'array', 'min:1'],
            'fechas.*.fecha' => ['required', 'date', 'after_or_equal:today'],
            'fechas.*.hora_inicio' => ['required', 'date_format:H:i'],
            'fechas.*.hora_fin' => ['required', 'date_format:H:i', 'after:fechas.*.hora_inicio'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'tipo_evento_id' => 'tipo de evento',
            'dependencia_id' => 'dependencia',
            'otra_dependencia' => 'otra dependencia',
            'organizador_id' => 'organizador',
            'notas_cta' => 'notas CTA',
            'notas_servicios_generales' => 'notas de servicios generales',
            'institucion_id' => 'institución',
            'fechas' => 'fechas',
            'fechas.*.fecha' => 'fecha',
            'fechas.*.hora_inicio' => 'hora de inicio',
            'fechas.*.hora_fin' => 'hora de fin',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fechas.required' => 'Debe agregar al menos una fecha para el evento.',
            'fechas.*.fecha.after_or_equal' => 'La fecha debe ser igual o posterior a hoy.',
            'fechas.*.hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
        ];
    }
}