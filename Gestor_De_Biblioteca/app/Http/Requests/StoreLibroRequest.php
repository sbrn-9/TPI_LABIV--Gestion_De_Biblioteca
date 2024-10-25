<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibroRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'codigo' => 'required|string|unique:libros,codigo',
            'cantidad' => 'required|integer|min:1',
            'disponibles' => 'required|integer|min:1|lte:cantidad',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'img_url' => 'nullable|string|max:500'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'imagen.required' => 'La imagen del libro es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe pesar más de 5MB.'
        ];
    }
}
