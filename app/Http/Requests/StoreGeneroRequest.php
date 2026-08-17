<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreGeneroRequest extends FormRequest
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
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u',
                Rule::unique('generos', 'nombre'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del género es obligatorio.',
            'nombre.string' => 'El nombre del género debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del género no puede tener más de 255 caracteres.',
            'nombre.regex' => 'El nombre del género solo puede contener letras y espacios.',
            'nombre.unique' => 'El nombre del género ya existe.',

            ];
    }
}
