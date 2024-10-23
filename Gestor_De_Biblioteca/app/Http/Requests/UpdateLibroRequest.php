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
            'descripcion' => 'required|string',
            'codigo' => 'required|string|unique:libros,codigo,'. $libro->id,
            'cantidad' => 'required|integer',
            'disponibles' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }
}
