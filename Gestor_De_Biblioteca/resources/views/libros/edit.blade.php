@extends('layouts.admindashboard')

@section('content')
<div class="container mt-4">
    <a href="{{route('libros.index')}}" class="btn btn-secondary mb-3">
        <i class="fa fa-chevron-left"></i> Atrás
    </a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editar Libro</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('libros.update', ['libro' => $libro->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor', $libro->autor) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $libro->descripcion) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', $libro->codigo) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $libro->cantidad) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="disponibles">Disponibilidad</label>
                    <input type="number" class="form-control" id="disponibles" name="disponibles" value="{{ old('disponibles', $libro->disponibles) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="categoria_id">Categoría</label>
                    <select class="form-control" id="categoria_id" name="categoria_id" required>
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
    </div>
</div>
@endsection
