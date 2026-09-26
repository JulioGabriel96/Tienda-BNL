<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeloVehiculoRequest extends FormRequest
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
        return [
            'nombre' => 'required|string|max:255|unique:modelos_vehiculos',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del modelo del vehículo es obligatorio.',
            'nombre.string' => 'El nombre del modelo del vehículo debe ser texto.',
            'nombre.max' => 'El nombre del modelo del vehículo no debe superar los :max caracteres.',
            'nombre.unique' => 'Ya existe un modelo del vehículo registrado con ese nombre.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del modelo del vehículo',
        ];
    }
}
