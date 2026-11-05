<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreModuloRequest extends FormRequest
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
            'nombre' => 'required|string|max:255|unique:modulos',
            'slug' => 'required|string|max:255|unique:modulos',
            'icono' => 'required|string|max:255',
            'ruta' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('modulos', 'ruta'),
                Rule::prohibitedIf($this->tipo_modulo == 1),
                Rule::requiredIf($this->tipo_modulo == 2),
            ],
            'estado' => 'required|boolean',
            'es_visible' => 'required|boolean',
            'tipo_modulo' => 'required|integer|in:1,2',
            'orden' => 'nullable|integer|min:1',
            'rela_padre' => [
                'nullable',
                'integer',
                Rule::exists('modulos', 'id')->where('tipo_modulo', 1)->where('estado', true),
                Rule::prohibitedIf($this->tipo_modulo == 1),
                Rule::requiredIf($this->tipo_modulo == 2),
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del módulo es obligatorio.',
            'nombre.string' => 'El nombre del módulo debe ser texto.',
            'nombre.max' => 'El nombre del módulo no debe superar los :max caracteres.',
            'nombre.unique' => 'Ya existe un módulo registrado con ese nombre.',
            'slug.required' => 'El slug del módulo es obligatorio.',
            'slug.string' => 'El slug del módulo debe ser texto.',
            'slug.max' => 'El slug del módulo no debe superar los :max caracteres.',
            'slug.unique' => 'Ya existe un módulo registrado con ese slug.',
            'icono.string' => 'El icono del módulo debe ser texto.',
            'icono.max' => 'El icono del módulo no debe superar los :max caracteres.',
            'icono.required' => 'El icono del módulo es obligatorio.',
            'ruta.string' => 'La ruta del módulo debe ser texto.',
            'ruta.max' => 'La ruta del módulo no debe superar los :max caracteres.',
            'ruta.unique' => 'Ya existe un módulo registrado con esa ruta.',
            'ruta.required' => 'La ruta del módulo es obligatoria para los módulos de tipo "Módulo".',
            'ruta.prohibited' => 'La ruta del módulo no debe ser proporcionada para los módulos de tipo "Contenedor".',
            'estado.boolean' => 'El estado seleccionado no es válido.',
            'es_visible.boolean' => 'La visibilidad seleccionada no es válida.',
            'tipo_modulo.required' => 'El tipo de módulo es obligatorio.',
            'tipo_modulo.integer' => 'El tipo de módulo seleccionado no es válido.',
            'tipo_modulo.in' => 'El tipo de módulo seleccionado no es válido.',
            'orden.integer' => 'El orden debe ser un número entero.',
            'rela_padre.integer' => 'El módulo padre seleccionado no es válido.',
            'rela_padre.exists' => 'El módulo padre seleccionado no existe o no es un módulo padre válido.',
            'rela_padre.prohibited' => 'El módulo padre no debe ser proporcionado para los módulos de tipo "Contenedor".',
            'rela_padre.required' => 'El módulo padre es obligatorio para los módulos de tipo "Módulo".',
        ];
    }
}
