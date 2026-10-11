<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreMarcaModeloVehiculoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 
    public function rules(): array
    {
        $marcaVehiculo = $this->route('marcaVehiculo');
        return [
            'modelo_id' => [
                'required',
                'integer',
                'exists:modelos_vehiculos,id',
                Rule::unique('marcas_modelos', 'modelo_id')
            ],
        ];
    }

    public function messages()
    {
        return [
            'modelo_id.required' => 'Debe seleccionar un modelo.',
            'modelo_id.integer' => 'El modelo seleccionado no es válido.',
            'modelo_id.exists' => 'El modelo seleccionado no existe.',
            'modelo_id.unique' => 'Este modelo ya está asociado a esta marca.',
        ];
    }

    public function attributes()
    {
        return [
            'modelo_id' => 'modelo_id',
        ];
    }
}
