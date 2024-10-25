@extends('layouts.Admindashboard')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Crear Nuevo Libro</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}">
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor') }}">
                    @error('autor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ old('codigo') }}">
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad') }}">
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="disponibles">Disponibilidad</label>
                    <input type="number" class="form-control @error('disponibles') is-invalid @enderror" id="disponibles" name="disponibles" value="{{ old('disponibles') }}">
                    @error('disponibles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
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

                <div class="form-group mb-3">
                    <label for="imagen">Imagen del Libro: </label>
                    <input type="file" class="@error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewImage(this)" >
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="preview" src="" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>

                <x-primary-button class="btn btn-primary">
                    {{ __('Guardar') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        previewDiv.style.display = 'none';
    }
}
</script>
@endsection
