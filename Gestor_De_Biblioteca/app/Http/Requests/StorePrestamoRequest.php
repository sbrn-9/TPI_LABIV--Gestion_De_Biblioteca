<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_prestamo',
            'libros' => ['required', 'array'], // Este será el array de libros
            'libros.*.libro_id' => ['required', 'exists:libros,id'], // Verificamos que el libro existe
            'libros.*.cantidad' => ['nullable', 'integer', 'min:1'], // Verificamos que la cantidad es válida
        ];
    }
}
