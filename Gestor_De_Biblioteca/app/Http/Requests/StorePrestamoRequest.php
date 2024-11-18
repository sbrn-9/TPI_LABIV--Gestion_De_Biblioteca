<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePrestamoRequest extends FormRequest
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
        $rules = [
            'fecha_prestamo' => 'required|date|after_or_equal:' . today()->toDateString(),
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'libros' => ['required', 'array'], // Este será el array de libros
            'libros.*.libro_id' => ['required', 'exists:libros,id'], // Verificamos que el libro existe
            'libros.*.cantidad' => ['nullable', 'integer', 'min:1'], // Verificamos que la cantidad es válida
        ];

        // Si el usuario es admin, requerimos el cliente_id
        if (Auth::user()->role->isAdmin()) {
            $rules['cliente_id'] = ['required', 'exists:users,id'];
        }

        // Agregamos reglas dinámicas para las cantidades máximas
        foreach ($this->input('libros', []) as $index => $libro) {
            $maximo = $libro['cantidad'] ?? 1;
            $rules['libros.' . $index . '.cantidad'][] = 'max:' . $maximo;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'cliente_id.required' => 'Debe seleccionar un cliente para el préstamo.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
            'libros.required' => 'Debe seleccionar al menos un libro para el préstamo.',
            'libros.*.libro_id.required' => 'El ID del libro es requerido.',
            'libros.*.libro_id.exists' => 'Uno de los libros seleccionados no existe.',
            'libros.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'libros.*.cantidad.min' => 'La cantidad mínima es 1.',
            'libros.*.cantidad.max' => 'La cantidad excede el número de libros disponibles.',
        ];
    }
}
