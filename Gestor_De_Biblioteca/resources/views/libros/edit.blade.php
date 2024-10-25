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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('libros.update', ['libro' => $libro->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $libro->titulo) }}" required>
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="autor">Autor</label>
                    <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor', $libro->autor) }}" required>
                    @error('autor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required>{{ old('descripcion', $libro->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo" value="{{ old('codigo', $libro->codigo) }}" required>
                    @error('codigo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" id="cantidad" name="cantidad" value="{{ old('cantidad', $libro->cantidad) }}" required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="disponibles">Disponibilidad</label>
                    <input type="number" class="form-control @error('disponibles') is-invalid @enderror" id="disponibles" name="disponibles" value="{{ old('disponibles', $libro->disponibles) }}" required>
                    @error('disponibles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="categoria_id">Categoría</label>
                    <select class="form-control @error('categoria_id') is-invalid @enderror" id="categoria_id" name="categoria_id" required>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $libro->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="imagen">Imagen del Libro: </label>
                    <input type="file" class="@error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewImage(this)">
                    @error('imagen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <div id="imagePreview" class="mt-2">
                        <div id="currentImage">
                            @if($libro->img_url)
                                <p>Imagen actual:</p>
                                <img src="{{ $libro->img_url }}" alt="Imagen actual del libro" style="max-width: 200px; max-height: 200px;" class="mb-2">
                            @endif
                        </div>
                        <div id="newImagePreview" style="display: none;">
                            <p>Nueva imagen:</p>
                            <img id="preview" src="" alt="Vista previa de la nueva imagen" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                </div>

                <x-primary-button class="btn btn-primary">
                    {{ __('Actualizar Libro') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('newImagePreview');
    const currentImage = document.getElementById('currentImage');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
            currentImage.style.display = 'none';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        previewDiv.style.display = 'none';
        currentImage.style.display = 'block';
    }
}
</script>
@endsection
