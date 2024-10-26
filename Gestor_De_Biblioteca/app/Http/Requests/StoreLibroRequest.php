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
            'descripcion' => 'required|string|max:2000',
            'codigo' => 'required|string|unique:libros,codigo',
            'cantidad' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'img_url' => 'nullable|string|max:500',
            'calificacion' => 'required|numeric|min:0|max:5',
            'editorial' => 'required|string|max:255',
            'fecha_publicacion' => 'required|date',
            'idioma' => 'required|string|max:50',
            'numero_paginas' => 'required|integer|min:1'
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
            'imagen.max' => 'La imagen no debe pesar más de 5MB.',
            'calificacion.required' => 'La calificación es obligatoria.',
            'calificacion.numeric' => 'La calificación debe ser un número.',
            'calificacion.min' => 'La calificación mínima es 0.',
            'calificacion.max' => 'La calificación máxima es 5.',
            'editorial.required' => 'La editorial es obligatoria.',
            'fecha_publicacion.required' => 'La fecha de publicación es obligatoria.',
            'fecha_publicacion.date' => 'La fecha de publicación debe ser una fecha válida.',
            'idioma.required' => 'El idioma es obligatorio.',
            'numero_paginas.required' => 'El número de páginas es obligatorio.',
            'numero_paginas.integer' => 'El número de páginas debe ser un número entero.',
            'numero_paginas.min' => 'El número de páginas debe ser mayor a 0.'
        ];
    }
}
