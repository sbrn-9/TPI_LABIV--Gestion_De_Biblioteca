@extends('layouts.admindashboard')

@section('content')
<div class="container">
    <a href="{{route('libros.index')}}" class="btn btn-primary" class="fa-solid fa-arrow-left"> Atrás</a>
    <h1>Editar Libro</h1>

    <form action="{{ route('libros.update', ['libro' => $libro->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required>
        </div>

        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor', $libro->autor) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $libro->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $libro->codigo) }}" required>
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $libro->cantidad) }}" required>
        </div>

        <div class="form-group">
            <label for="disponibles">Disponibilidad</label>
            <input type="number" class="form-control" id="disponibles" name="disponibles" value="{{ old('disponibles', $libro->disponibles) }}" required>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id" required>
                <!-- Aquí deberías cargar las categorías disponibles -->
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $libro->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-primary-button class="btn btn-primary">
            {{ __('Actualizar Libro') }}
        </x-primary-button>
    </form>
</div>
@endsection