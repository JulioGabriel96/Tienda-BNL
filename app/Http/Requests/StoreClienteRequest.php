<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreClienteRequest extends FormRequest
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
            //
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'genero_id' => 'required|exists:generos,id|integer',
            'tipo_cliente_id' => 'required|exists:tipo_clientes,id|integer',
            'telefono' => 'required|string',
            'email' => 'required|string|email|max:255|unique:clientes,email',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ];
    } 

     public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del cliente es obligatorio.',
            'nombre.string' => 'El nombre del cliente debe ser texto.',
            'nombre.max' => 'El nombre del cliente no debe superar el mÃ¡ximo de 255 caracteres.',
            'apellido.required' => 'El apellido del cliente es obligatorio.',
            'apellido.string' => 'El apellido del cliente debe ser texto.',
            'apellido.max' => 'El apellido del cliente no debe superar el mÃ¡ximo de 255 caracteres.',
            'genero_id.required' => 'El género del cliente es obligatorio.',
            'tipo_cliente_id.required' => 'El tipo de cliente es obligatorio.',
            'telefono.required' => 'El teléfono del cliente es obligatorio.',
            'telefono.string' => 'El teléfono del cliente debe ser un texto.',
            'estado.boolean' => 'El estado seleccionado no es válido.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento del cliente es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento del cliente debe ser una fecha válida.',
            'direccion.max' => 'La dirección del cliente no debe superar el máximo de 255 caracteres.',
            'email.required' => 'El correo electrónico del cliente es obligatorio.',
            'email.string' => 'El correo electrónico del cliente debe ser texto.',
            'email.email' => 'El correo electrónico del cliente debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico del cliente no debe superar el máximo de 255 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del cliente',
            'apellido' => 'apellido del cliente',
            'genero_id' => 'gÃ©nero',
            'tipo_cliente_id' => 'tipo de cliente',
            'telefono' => 'telÃ©fono',
            'estado' => 'estado',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'direccion' => 'direcciÃ³n',
        ];
    }
}
