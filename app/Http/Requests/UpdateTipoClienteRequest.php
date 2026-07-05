<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoClienteRequest extends FormRequest
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
                Rule::unique('tipo_clientes', 'nombre')->ignore($this->route('tipoCliente')),
            ],
            'descuento' => ['required', 'integer', 'min:0', 'max:100'],
            'estado' => ['nullable', 'integer', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del tipo de cliente es obligatorio.',
            'nombre.string' => 'El nombre del tipo de cliente debe ser texto.',
            'nombre.max' => 'El nombre no debe superar los :max caracteres.',
            'nombre.unique' => 'Ya existe un tipo de cliente registrado con ese nombre.',
            'descuento.required' => 'El descuento es obligatorio.',
            'descuento.integer' => 'El descuento debe ser un número entero.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede superar el 100%.',
            'estado.integer' => 'El estado seleccionado no es válido.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del tipo de cliente',
            'descuento' => 'descuento',
            'estado' => 'estado',
        ];
    }
}
