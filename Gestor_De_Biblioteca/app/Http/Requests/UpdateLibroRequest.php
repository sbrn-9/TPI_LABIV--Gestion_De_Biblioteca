<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibroRequest extends FormRequest
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
        //obtenemos el libro de la ruta en la que estamos actualmente
        $libro = $this->route('libro');
        return [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descripcion' => 'required|string|max:2000',
            'codigo' => 'required|string|unique:libros,codigo,'. $libro->id,
            'cantidad' => 'required|integer',
            'disponibles' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'img_url' => 'nullable|string|max:500',
            'calificacion' => 'nullable|numeric|min:0|max:5',
            'editorial' => 'nullable|string|max:255',
            'fecha_publicacion' => 'nullable|date',
            'idioma' => 'nullable|string|max:50',
            'numero_paginas' => 'nullable|integer|min:1'
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
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
            'imagen.max' => 'La imagen no debe pesar más de 5MB.',
            'calificacion.numeric' => 'La calificación debe ser un número.',
            'calificacion.min' => 'La calificación mínima es 0.',
            'calificacion.max' => 'La calificación máxima es 5.',
            'fecha_publicacion.date' => 'La fecha de publicación debe ser una fecha válida.',
            'numero_paginas.integer' => 'El número de páginas debe ser un número entero.',
            'numero_paginas.min' => 'El número de páginas debe ser mayor a 0.'
        ];
    }
}
