<?php

namespace App\Http\Requests;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'codigo' => trim((string) $this->input('codigo')),
            'codigo_barra' => $this->filled('codigo_barra')
                ? trim((string) $this->input('codigo_barra'))
                : null,
            'nombre' => trim((string) $this->input('nombre')),
            'descripcion' => $this->filled('descripcion')
                ? trim((string) $this->input('descripcion'))
                : null,
        ]);
    }

    public function rules(): array
    {
        $producto = $this->route('producto');

        return [
            'codigo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('productos', 'codigo')->ignore($producto),
            ],
            'codigo_barra' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('productos', 'codigo_barra')->ignore($producto),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio_costo' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'porcentaje_ganancia' => ['required', 'numeric', 'min:0', 'max:999.99'],
            'precio_venta' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'stock_minimo' => ['required', 'integer', 'min:0'],
            'stock_actual' => ['prohibited'],
            'estado' => ['required', 'boolean'],
            'marca_id' => ['required', Rule::exists('marcas', 'id')],
            'categoria_id' => ['required', Rule::exists('categorias', 'id')],
            'subcategoria_id' => [
                'required',
                Rule::exists('sub_categorias', 'id')->where(
                    fn ($query) => $query->where('categoria_id', $this->input('categoria_id'))
                ),
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->isNotEmpty() || ! $this->filled('codigo_barra')) {
                return;
            }

            $producto = $this->route('producto');

            $productoRepetido = Producto::query()
                ->whereKeyNot($producto->getKey())
                ->where('codigo_barra', $this->input('codigo_barra'))
                ->where('descripcion', $this->input('descripcion'))
                ->where('marca_id', $this->input('marca_id'))
                ->whereHas('subcategoria', function ($query) {
                    $query->where('categoria_id', $this->input('categoria_id'));
                })
                ->exists();

            if ($productoRepetido) {
                $validator->errors()->add(
                    'codigo_barra',
                    'Ya existe un producto con el mismo código de barras, descripción, marca y categoría.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código interno es obligatorio.',
            'codigo.unique' => 'Ya existe un producto con ese código interno.',
            'codigo_barra.unique' => 'Ya existe un producto con ese código de barras.',
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio_costo.required' => 'El precio de costo es obligatorio.',
            'precio_costo.numeric' => 'El precio de costo debe ser un número.',
            'porcentaje_ganancia.required' => 'El porcentaje de ganancia es obligatorio.',
            'precio_venta.required' => 'El precio de venta es obligatorio.',
            'precio_venta.numeric' => 'El precio de venta debe ser un número.',
            'stock_minimo.required' => 'El stock mínimo es obligatorio.',
            'stock_minimo.integer' => 'El stock mínimo debe ser un número entero.',
            'stock_actual.prohibited' => 'El stock actual no puede modificarse desde la edición del producto.',
            '*.min' => 'El campo :attribute no puede ser negativo.',
            'marca_id.required' => 'Debe seleccionar una marca.',
            'marca_id.exists' => 'La marca seleccionada no es válida.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'subcategoria_id.required' => 'Debe seleccionar una subcategoría.',
            'subcategoria_id.exists' => 'La subcategoría no pertenece a la categoría seleccionada.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.boolean' => 'El estado seleccionado no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código interno',
            'codigo_barra' => 'código de barras',
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'precio_costo' => 'precio de costo',
            'porcentaje_ganancia' => 'porcentaje de ganancia',
            'precio_venta' => 'precio de venta',
            'stock_minimo' => 'stock mínimo',
            'stock_actual' => 'stock actual',
            'estado' => 'estado',
            'marca_id' => 'marca',
            'categoria_id' => 'categoría',
            'subcategoria_id' => 'subcategoría',
        ];
    }
}
