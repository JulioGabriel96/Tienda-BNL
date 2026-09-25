<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaVehiculoRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:marcas_vehiculos',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la marca del vehículoes obligatorio.',
            'nombre.string' => 'El nombre de la marca del vehículo debe ser texto.',
            'nombre.max' => 'El nombre de la marca del vehículo no debe superar los :max caracteres.',
            'nombre.unique' => 'Ya existe una marca del vehículo registrada con ese nombre.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre de la marca del vehículo',
        ];
    }
}
  