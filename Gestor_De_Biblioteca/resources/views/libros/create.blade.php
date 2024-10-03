@extends('layouts.admindashboard')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Libro</h2>

        <form action="{{ route('libros.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>

            <div class="form-group">
                <label for="disponibles">Disponibilidad</label>
                <input type="number" class="form-control" id="disponibles" name="disponibles" required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control" id="categoria_id" name="categoria_id">
                @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}"> {{$categoria->nombre}}</option>
                @endforeach
                </select>
            </div>
            <x-primary-button class="btn btn-primary">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
@endsection