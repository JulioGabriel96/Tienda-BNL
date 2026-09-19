<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateClienteRequest extends FormRequest
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
            'nombre' => ['required','string','max:255',

                Rule::unique('clientes', 'nombre')
                    ->where(function ($query) {
                        return $query
                            ->where('apellido', $this->apellido)
                            ->where('email', $this->email)
                            ->where('tipo_cliente_id', $this->tipo_cliente_id)
                            ->where('genero_id', $this->genero_id);
                    })->ignore($this->cliente)
            ],
            'apellido' => ['required','string','max:255',],
            'email' => ['required','email',Rule::unique('clientes', 'email')->ignore($this->cliente),],
            'tipo_cliente_id' => ['required','integer','exists:tipo_clientes,id',],
            'genero_id' => ['required','integer','exists:generos,id',],
            'estado' => ['required','boolean',],
            'fecha_nacimiento' => ['required','date',],
            'direccion' => ['nullable','string','max:255',],
            'telefono' => ['required','string',],

        ]; 
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser un texto.',
            'apellido.max' => 'El apellido no puede superar los 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'tipo_cliente_id.required' => 'El tipo de cliente es obligatorio.',
            'genero_id.required' => 'El género es obligatorio.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.boolean' => 'El estado debe ser verdadero o falso.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'direccion.string' => 'La dirección debe ser un texto.',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres.',
            'nombre.unique' => 'Ya existe un cliente con los mismos datos ingresados.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser un texto.',
         ];
    }


}
