<?php

namespace App\Http\Requests;

use App\Models\Libros_Prestados;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestamoRequest extends FormRequest
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
        //obtenemos el prestamo de la ruta en la que estamos actualmente
        $prestamo = $this->route('prestamo');
        //obtenemos los registros de la tabla intermedia vinculados a este prestamo
        $librosPrestados = Libros_Prestados::where('prestamo_id', $prestamo->id)->get();

        $rules =  [
            'fecha_prestamo' => ['required', 'date', 'after_or_equal:' . $prestamo->fecha_prestamo],
            'fecha_devolucion' => ['required', 'date', 'after_or_equal:fecha_prestamo'],
            'libros' => ['required', 'array'],
            'libros.*.libro_id' => ['required', 'exists:libros,id'],
            'libros.*.cantidad' => ['nullable', 'integer', 'min:0'],
        ];
        //Regla dinámica
        foreach($librosPrestados as $index => $info)
        {
            /*
            para generar el maximo debemos sumar la disponibilidad anterior mas la cantidad pedida anterior
            como si se devolvieran los libros y se pidieran de nuevo, para tener la disponibilidad total
            */

            //tomamos la cantidad pedida anteriormente
            $cantidadPedidaAnterior = $info->cantidad;

            //tomamos la disponibilidad del libro anteriormente
            $libro = $prestamo->libros()->where('libros.id', $info->libro_id)->first();

            if($libro){

            $DisponiblesAntesDeEditar = $libro->disponibles;

            $maximo = $cantidadPedidaAnterior + $DisponiblesAntesDeEditar;

            //ya muchas veces funcionó mal asique verifico que la regla exista sino la creo
            if (!isset($rules['libros.' . $index . '.cantidad'])) {
                $rules['libros.' . $index . '.cantidad'] = ['nullable', 'integer', 'min:0'];
            }
            //agregamos la regla dinámica para el valor maximo de libros para el prestamo
            $rules['libros.' . $index . '.cantidad'][] = 'max:' . $maximo;
            }
        }

        return $rules;
    }
}
