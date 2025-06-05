<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UpdateCitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'apellido' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'tipo_documento' => ['required', Rule::in(['cc', 'ti', 'cxe', 'pasaporte'])],
            'numero_documento' => [
                'required',
                'string',
                'max:20',
                Rule::unique('citas')
                    ->ignore($this->route('cita'))
                    ->where(function ($query) {
                        return $query->where('dia', $this->dia);
                    }),
            ],
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
            'estado' => ['nullable', Rule::in(['pendiente', 'confirmada', 'completada', 'cancelada', 'no_asistio'])],
            'observaciones' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'numero_documento.unique' => 'Ya existe una cita registrada para este número de documento en esa fecha.',
            'hora.date_format' => 'El formato de la hora debe ser HH:MM',
            'dia.after_or_equal' => 'La fecha debe ser hoy o una futura',
        ];
    }
}
