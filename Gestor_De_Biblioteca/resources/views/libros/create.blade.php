@extends('layouts.Admindashboard')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Libro</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('libros.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}">
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}" >
                @error('autor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" >{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ old('codigo') }}" >
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" >
                @error('cantidad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="disponibles">Disponibilidad</label>
                <input type="number" class="form-control" id="disponibles" name="disponibles" required>
                <input type="number" class="form-control @error('disponibles') is-invalid @enderror" id="disponibles" name="disponibles" value="{{ old('disponibles') }}" >
                @error('disponibles')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
                </select>
                @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <x-primary-button class="btn btn-primary">
                {{ __('Guardar') }}
            </x-primary-button>
        </form>
    </div>
@endsection
