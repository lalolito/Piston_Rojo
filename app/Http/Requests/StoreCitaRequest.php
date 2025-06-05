<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_servicio' => ['required', Rule::in([
                'cambio_aceite',
                'revision_general',
                'mantenimiento_general',
                'alineacion',
                'frenos',
                'suspension',
                'electrico'
            ])],
            'dia' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    if (date('N', strtotime($value)) >= 6) {
                        $fail('No se permiten citas los fines de semana.');
                    }
                }
            ],
            'hora' => [
                'required',
                'date_format:H:i',
                'after_or_equal:08:00',
                'before_or_equal:18:00',
                function ($attribute, $value, $fail) {
                    $hora = Carbon::parse($value);
                    if ($hora->minute % 15 !== 0) {
                        $fail('Las citas deben ser en intervalos de 15 minutos.');
                    }
                }
            ],
            'observaciones' => 'nullable|string|max:500'
        ];
    }

    public function messages(): array
    {
        return [
            'tipo_servicio.required' => 'Debe seleccionar un tipo de servicio.',
            'tipo_servicio.in' => 'El tipo de servicio seleccionado no es válido.',
            'dia.required' => 'Debe elegir una fecha para la cita.',
            'dia.after_or_equal' => 'No se pueden agendar citas en fechas pasadas.',
            'hora.required' => 'Debe ingresar una hora para la cita.',
            'hora.date_format' => 'El formato de hora debe ser HH:MM (ej: 09:15)',
            'hora.after_or_equal' => 'La hora debe ser después de las 08:00',
            'hora.before_or_equal' => 'La hora debe ser antes de las 18:00',
        ];
    }
}
