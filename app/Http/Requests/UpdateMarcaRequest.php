<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMarcaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('marcas', 'nombre')->ignore($this->route('marca')),
            ],
            'descripcion' => 'nullable|string',
            'estado' => 'nullable|integer|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la marca es obligatorio.',
            'nombre.string' => 'El nombre de la marca debe ser texto.',
            'nombre.max' => 'El nombre de la marca no debe superar los :max caracteres.',
            'nombre.unique' => 'Ya existe una marca registrada con ese nombre.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'estado.integer' => 'El estado seleccionado no es valido.',
            'estado.in' => 'El estado seleccionado no es valido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre de la marca',
            'descripcion' => 'descripcion',
            'estado' => 'estado',
        ];
    }
}
