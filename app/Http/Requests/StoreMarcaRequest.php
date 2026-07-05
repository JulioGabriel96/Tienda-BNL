<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcaRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:marcas',
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
